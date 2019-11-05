<?php

namespace App\Http\Controllers\Modules\Photographer;

use App\Album;
use App\Bookings;
use App\Http\Controllers\Controller;
use App\Jobs\PhotographerAddedJob;
use App\Payment;
use App\PeexooPhotographyCommunityModel;
use App\Photographer;
use App\PhotographerBankAccountDetails;
use App\PhotographerPackage;
use App\PhotographerPortfolioCategory;
use App\PhotographerPortfolioCategoryApp;
use App\User;
use App\UserSubscription;
use App\UtilityModels\Photographer\PhotographerManager;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PhotographerController extends Controller
{
    private $photographerManager;
    public function __construct(PhotographerManager $photographerManager)
    {
        $this->photographerManager=$photographerManager;
    }

    /**
     * @OA\POST(
     *     path="/api/photographer/community",
     *     tags={"photographer"},
     *     summary="Adds the User details to the Peexoo Photographer Community",
     *     operationId="joinCommunity",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function joinCommunity(Request $request){
        $user_details=$request->all();
        $user_details['is_vetted']=false;
        $community_member=new PeexooPhotographyCommunityModel($user_details);
        if(!$community_member->save()){
            return response()->json(['status'=>400,'message'=>'Failed to join photographer community','data'=>null]);
        }
        return response()->json(['status'=>200,'message'=>'Successfully joined the community','data'=>$community_member]);
    }

    /**
     * @OA\POST(
     *     path="/api/photographer/join",
     *     tags={"photographer"},
     *     summary="Add an Authenticated User to the list of Photographers",
     *     operationId="join",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function join(Request $request){
        try{
            $user=auth()->user();
            return $this->addUserToPhotographer($user,$request->about_us);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    public function addUserToPhotographer($user,$about_us,$category,$photography_type,$region,$business_name){

        if(!$user){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>$user]);
        }

        if($user->archived){
            return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
        }

        $photographer=Photographer::where('user_id',$user->id)->first();

        if($photographer){
            return response()->json(['status'=>400,'message'=>'User has already joined','data'=>null]);
        }

        $photographer=new Photographer(['user_id'=>$user->id,'verified'=>false,'archived'=>false,'about_us'=>$about_us,
            'region'=>$region,'business_name'=>$business_name,
            'bvn'=>null,'bvn_meta'=>null,'bvn_verified'=>false,'id_card'=>null,'id_card_verified'=>false
        ]);

        if(!$photographer->save()){
            return response()->json(['status'=>400,'message'=>'Failed to add Photographer','data'=>null]);
        }
        $photographer=Photographer::where('user_id',$user->id)->first();
        //create Photographer CoverImages Album
//        $album_coverimage=new Album([
//            'title'=>'Photographer, '.$user->email.'\'s Cover Images Album',
//            'type'=>Album::$TYPE_PHOTOGRAPHER_COVER_IMAGE,'archived'=>true,'source'=>json_encode($photographer),'privacy'=>'private','status'=>'','album_hash'=>''
//        ]);
//
//        if(!$album_coverimage->save()){
//            return response()->json(['status'=>400,'message'=>'Failed to create Photographer Cover images Album','data'=>null]);
//        }
//
//        //create Photographer HomePageSlider Album
//        $album_homepageslider=new Album([
//            'title'=>'Photographer, '.$user->email.'\'s HomePage Slider Album',
//            'type'=>Album::$TYPE_PHOTOGRAPHER_HOMEPAGE_SLIDER_IMAGE,'archived'=>true,'source'=>json_encode($photographer),'privacy'=>'private','status'=>'','album_hash'=>''
//        ]);
//
//        if(!$album_homepageslider->save()){
//            return response()->json(['status'=>400,'message'=>'Failed to create Photographer Cover images Album','data'=>null]);
//        }

        $photographer=Photographer::where('user_id',$user->id)->first();
        PhotographerAddedJob::dispatch($user);
        return response()->json(['status'=>200,'message'=>'Photographer successfully added','data'=>$photographer]);

    }

    /**
     * @OA\PUT(
     *     path="/api/photographer/",
     *     tags={"photographer"},
     *     summary="Updates a photographer's profile",
     *     operationId="update",
     *     @OA\RequestBody(
     *         description="Photographer Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Photographer")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function update(Request $request){
        try{
            $user=auth()->user();

            $photographer=Photographer::where(['user_id'=>$user->id])->first();

            $updates=[];
            $param=['region','business_name','about_us','bvn','id_card'];

            foreach ($param as $key=>$p){
                if(isset($request[$p]) && !empty($request[$p])){

                    if($p==='bvn'){
                        $paystack=new Payment();
                        $resolves=$paystack->verifyBVN($request[$p]);
//                        {
//                                                    "status": true,
//                          "message": "BVN resolved",
//                          "data": {
//                                                    "first_name": "WES",
//                            "last_name": "GIBSONS",
//                            "dob": "14-OCT-96",
//                            "mobile": "09022092102",
//                            "bvn": "21212917741"
//                          },
//                          "meta": {
//                                                    "calls_this_month": 1,
//                            "free_calls_left": 9
//                          }
//                        }
                        Log::info(json_encode($resolves));
                        $status=$resolves->status;
                        if(!$status){
                            continue;
                        }
                    }

                    $updates[$p]=$request[$p];
                }
            }

            if(!$photographer->update($updates)){
                return response()->json(['status'=>400,'message'=>'Failed to update Photographer','data'=>null]);
            }

            $user_updates=[];
            if(isset($request['first_name'])){
                $user_updates['first_name']=$request['first_name'];
            }
            if(isset($request['last_name'])){
                $user_updates['last_name']=$request['last_name'];
            }

            if(count($user_updates)>0) {
                $user = User::where(['id' => $user->id])->first();
                if (!$user->update($user_updates)) {
                    return response()->json(['status' => 400, 'message' => 'Failed to update User', 'data' => null]);
                }
            }
                $user = User::where(['id' => $user->id])->with("photographer")->first();
            $user['photographer']=$photographer;

            return response()->json(['status'=>200,'message'=>'Photographer updated successfully','data'=>$user]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Error updating BVN','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\PATCH(
     *     path="/api/photographer/bvn",
     *     tags={"photographer"},
     *     summary="Updates a photographer's bvn",
     *     operationId="updateBVN",
     *     @OA\RequestBody(
     *         description="Photographer Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Photographer")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function updateBVN(Request $request){
        try{
            $user=auth()->user();
            $user=User::where(['id'=>3])->first();
            $photographer=Photographer::where(['user_id'=>$user->id])->first();
            $request=$request->all();
            $request['bvn'];

            if(!isset($request['bvn']) || empty($request['bvn'])){
                return response()->json(['status'=>400,'message'=>'Bvn Input not found','data'=>null]);
            }

            $paystack=new Payment();
            $resolves=$paystack->verifyBVN($request['bvn']);

//            return $resolves;
//            {
//                "status": true,
//                  "message": "BVN resolved",
//                  "data": {
//                    "first_name": "STEVEN",
//                    "last_name": "NWADIKE",
//                    "dob": "23-May-92",
//                    "formatted_dob": "1992-05-23",
//                    "mobile": "07065146303",
//                    "bvn": "22178888264"
//                  },
//                  "meta": {
//                    "calls_this_month": 2,
//                    "free_calls_left": 8
//                  }
//                }

            $paystack_bvn_data=json_decode($resolves,true);
            if(strtoupper($user->last_name) != strtoupper($paystack_bvn_data['data']['last_name'])){
                return response()->json(['status'=>400,'message'=>'BVN name mismatch','data'=>null]);
            }

            if(!$photographer->update(['bvn'=>$request['bvn'],'bvn_meta'=>"".$resolves])){
                return response()->json(['status'=>400,'message'=>'Failed to update Photographer BVN','data'=>null]);
            }

            return response()->json(['status'=>200,'message'=>'Photographer BVN updated successfully','data'=>$photographer]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Error updating BVN','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/",
     *     tags={"photographer"},
     *     summary="Gets the Photographer Object for an authenticated User",
     *     operationId="getAuthPhotographer",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getAuthPhotographer(Request $request){
        try{
            $user=auth()->user();

            if(!$user){
                return response()->json(['status'=>404,'message'=>'User not found','data'=>$user]);
            }

            if($user->archived){
                return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
            }

            $photographer=Photographer::where('user_id',$user->id)->with('user')->first();

            if(!$photographer){
                return response()->json(['status'=>404,'message'=>'User is not a Photographer','data'=>null]);
            }

            if($photographer->archived){
                return response()->json(['status'=>400,'message'=>'Photographer has been deactivated','data'=>null]);
            }


            return response()->json(['status'=>200,'message'=>'Photographer fetched successfully ','data'=>$photographer]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/id/{id}",
     *     tags={"photographer"},
     *     summary="Gets the Photographer Object using photographer Id",
     *     operationId="getPhotographerById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the Photographer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getPhotographerById(Request $request){
        try{
            $user=auth()->user();

            if(!$user){
                return response()->json(['status'=>404,'message'=>'User not found','data'=>$user]);
            }

            if($user->archived){
                return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
            }

            $photographer=Photographer::where('user_id',$user->id)
//                ->with('calendar')
//                ->with('gallery')
//                ->with('reviews')
//                  ->with('bookings.shoots')
                ->first();

            if(!$photographer){
                return response()->json(['status'=>404,'message'=>'User is not a Photographer','data'=>null]);
            }

            if($photographer->archived){
                return response()->json(['status'=>400,'message'=>'Photographer has been deactivated','data'=>null]);
            }

            return response()->json(['status'=>200,'message'=>'Photographer fetched successfully ','data'=>$photographer]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    public function loginToPhotographerAccount(Request $request){

    }

    /**
     * @OA\POST(
     *     path="/api/photographer/search",
     *     tags={"photographer"},
     *     summary="Searches for Photographers",
     *     operationId="searchPhotographers",
     *     @OA\RequestBody(
     *         description="Photographer Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerSearchParams")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function searchPhotographers(Request $request){
        try{

            $request->sort = ($request->sort == null )?'asc':$request->sort;
            $request->start = ($request->start == null )?0:$request->start;
            $request->limit = ($request->limit == null )?100:$request->limit;

            $photographer=$this->photographerManager->searchPhotographers($request->all(),$request->sort,$request->start,$request->limit);
            return response()->json(['status'=>200,'message'=>'Photographer search fetched successfully ','data'=>$photographer]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Error fetching data','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\POST(
     *     path="/api/photographer/report",
     *     tags={"photographer"},
     *     summary="Report a Photographers",+
     *     operationId="reportPhotographer",
     *     @OA\RequestBody(
     *         description="Photographer Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Photographer")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function reportPhotographer(Request $request){
        try{

//            $photographer=Photographer::where('user_id',$user->id)->get();
//
//            //get Photographers that are not archived, fit search criteria and have subscribed to their package
//
//            return response()->json(['status'=>200,'message'=>'Photographer fetched successfully ','data'=>$photographer]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\POST(
     *     path="/api/photographer/bankdetails/",
     *     tags={"bankdetails"},
     *     summary="Adds a new BankDetail for a Photographer",
     *     operationId="addBankDetails",
     *      @OA\RequestBody(
     *         description="Photographer Bank Account Details Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerBankAccountDetails")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function addBankDetails(Request $request){
        try{
            $user=auth()->user();

            $photographer=Photographer::where(['user_id'=>$user->id])->first();

            if(!$photographer){
                return response()->json(['status'=>404,'message'=>'User is not a Photographer','data'=>null]);
            }

            $account_exists=PhotographerBankAccountDetails::where(['account_number'=>$request->account_number])->first();

            if($account_exists){
                return response()->json(['status'=>404,'message'=>'Bank Account number exists','data'=>null]);
            }

            $bank_details=new PhotographerBankAccountDetails([
                'photographer_id'=>$photographer->id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'bank_name'=>$request->bank_name,
                'account_number'=>$request->account_number
            ]);

            if(!$bank_details->save()){
                return response()->json(['status'=>404,'message'=>'Failed to add BankAccount Detail','data'=>null]);
            }

            return response()->json(['status'=>404,'message'=>'BankAccount Detail added successfully','data'=>$bank_details]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/bankdetails/",
     *     tags={"bankdetails"},
     *     summary="Gets BankDetails for a Photographer",
     *     operationId="getBankDetails",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getBankDetails(Request $request){
        try{
            $user=auth()->user();

            $photographer=Photographer::where(['user_id'=>$user->id])->first();

            if(!$photographer){
                return response()->json(['status'=>404,'message'=>'User is not a Photographer','data'=>null]);
            }

            $accounts=PhotographerBankAccountDetails::where(['photographer_id'=>$photographer->id])->get();

            return response()->json(['status'=>404,'message'=>'BankAccounts fetched successfully','data'=>$accounts]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'User not found','data'=>null,'error'=>$e->getMessage()]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/details/",
     *     tags={"bankdetails"},
     *     summary="Gets BankDetails for a Photographer",
     *     operationId="getProfileDetails",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getProfileDetails(Request $request){

    }

        /**
         * @OA\GET(
         *     path="/api/photographer/calendar/{photographer_id}/{start_date}/{end_date}",
         *     tags={"photographer"},
         *     summary="Gets Photographer's availability dates",
         *     operationId="getPhotographerCalendarSchedules",
         *     @OA\Parameter(
         *         name="photographer_id",
         *         in="path",
         *         description="Id of the Photographer",
         *         required=true,
         *         @OA\Schema(
         *             type="integer",
         *             format="int64"
         *         )
         *     ),
         *     @OA\Parameter(
         *         name="start_date",
         *         in="path",
         *         description="The start date that the calendar should start from",
         *         required=true,
         *         @OA\Schema(
         *             type="string",
         *         )
         *     ),
         *     @OA\Parameter(
         *         name="end_date",
         *         in="path",
         *         description="The end date that the calendar should end to",
         *         required=true,
         *         @OA\Schema(
         *             type="string",
         *         )
         *     ),
         *     @OA\Response(
         *         response=405,
         *         description="Invalid input"
         *     )
         * )
         */
        public function getPhotographerCalendarSchedules(Request $request){
            try{
                $calendar_events=$this->photographerManager->getUserCalendarEvents($request->photographer_id,$request->start_date,$request->end_date,100);
                return response()->json(['status'=>200,'message'=>'Calendar dates successfully','data'=>$calendar_events]);
            }catch (\Exception $e){
                return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
            }

        }

    /**
     * @OA\POST(
     *     path="/api/photographer/calendar",
     *     tags={"photographer"},
     *     summary="Adds a Calendar event for a photographer",
     *     operationId="addCalendarSchedule",
     *     @OA\RequestBody(
     *         description="Photographer Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PeexooCalendar")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
        public function addCalendarSchedule(Request $request){
            try{
                $data=$this->photographerManager->addCalendarEvent($request->user_id,$request->start_date,$request->end_date,$request->description,'',0);
                return response()->json(['status'=>200,'message'=>'Calendar dates added successfully','data'=>$data]);
            }catch (\Exception $e){
                return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
            }
        }

    /**
     * @OA\GET(
     *     path="/api/photographer/bookings",
     *     tags={"photographer"},
     *     summary="Gets Photographer's bookings",
     *     operationId="getPhotographerBookings",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
        public function getPhotographerBookings(Request $request){
            $user=null;
            $sort='desc';
            $start=0;
            $limit=100;


            try{
                $user=auth()->user();
            }catch (\Exception $e){
                return response()->json(['status'=>404,'message'=>'Auth failed','data'=>null,'error'=>$e->getMessage()]);
            }

            if(!$user){
                return response()->json(['status'=>404,'message'=>'User does not exist','data'=>null]);
            }
            $photographer=Photographer::where(['user_id'=>$user->id])->first();
            $photographerBookings=Bookings::select()->where(['photographer_id'=>$photographer->id])
            ->with('user')
            //->with('category')
            ->with('payments.installments')
            ->orderBy('id',$sort)
            ->offset($start)
            ->limit($limit);
            return response()->json(['status'=>200,'message'=>'Photographer Bookings fetched successfully','data'=>$photographerBookings->get()]);
        }

    /**
     * @OA\POST(
     *     path="/api/photographer/setupPhotographerPortfolioCategories",
     *     tags={"photographer"},
     *     summary="Setup photographer portfolio categories",
     *     operationId="addPhotographerCategory",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\RequestBody(
     *         description="PhotographerPortfolioCategory Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerPortfolioCategory")
     *     ),
     * )
     */
        public function addPhotographerCategory(Request $request){
            $phc=new PhotographerPortfolioCategory($request->all());
            $phc->save();
            return 'Done';
        }


    /**
     * @OA\GET(
     *     path="/api/photographer/notification/setting",
     *     tags={"photographer"},
     *     summary="Gets Photographer's Notification settings",
     *     operationId="getPhotographerNotificationSettings",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getPhotographerNotificationSettings(Request $request){
        try{
            $notifications=$this->photographerManager->getNotifications(3);
            return response()->json(['status'=>200,'message'=>'Photographer Notifications fetched successfully','data'=>$notifications]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/carddetails/{photographer_id}",
     *     tags={"photographer"},
     *     summary="Gets Photographer's Card details",
     *     operationId="getPhotographerATMCardDetails",
     *     @OA\Parameter(
     *         name="photographer_id",
     *         in="path",
     *         description="Id of the Photographer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getPhotographerATMCardDetails(Request $request){
        try{
            $notifications=$this->photographerManager->getPhotographerCardDetails($request->photographer_id);
            return response()->json(['status'=>200,'message'=>'Photographer ATM Cards fetched successfully','data'=>$notifications]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\POST(
     *     path="/api/photographer/carddetails",
     *     tags={"photographer"},
     *     summary="Adds a Photographer's Card details",
     *     operationId="savePhotographerATMCardDetails",
     *     @OA\RequestBody(
     *         description="ATM Card Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerCardDetails")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function savePhotographerATMCardDetails(Request $request){
        try{
            $notifications=$this->photographerManager->addPhotographerCardDetails($request->photographer_id,$request->all());
            return response()->json(['status'=>200,'message'=>'Photographer ATM Cards fetched successfully','data'=>$notifications]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\POST(
     *     path="/api/photographer/pricingpackage",
     *     tags={"photographer"},
     *     summary="Creates a pricing package for a photographer",
     *     operationId="savePhotographerPackage",
     *     @OA\RequestBody(
     *         description="ATM Card Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerPricingPackage")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),

     * )
     */
    public function savePhotographerPackage(Request $request){

//        *     security={
//            *         {"api_key_scheme": {}}
//            *     }

        $user=null;
        try{
//            $user=auth()->user();
            $user=User::where(['id'=>3])->first();
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth failed','data'=>null,'error'=>$e->getMessage()]);
        }


        try{
            $package=$this->photographerManager->addPricingPackage($user,"My Pacakge 0.1",3,20045,
                [
                    ['title'=>'Bathing Babies',
                    'quantity'=>3,
                    'price'=>500.0
                    ]
                 ]
            );
            $package=PhotographerPackage::where(['id'=>$package->id])->with("packageitems")->first();
            return response()->json(['status'=>200,'message'=>'Photographer\s Pricing Package saved successfully','data'=>$package]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\DELETE(
     *     path="/api/photographer/pricingpackage/{pricingpackage_id}",
     *     tags={"photographer"},
     *     summary="Creates a pricing package for a photographer",
     *     operationId="deletePhotographerPackage",
     *     @OA\Parameter(
     *         name="pricingpackage_id",
     *         in="path",
     *         description="The id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),

     * )
     */
    public function deletePhotographerPackage(Request $request){

//        *     security={
//            *         {"api_key_scheme": {}}
//            *     }

        $user=null;
        try{
//            $user=auth()->user();
            $user=User::where(['id'=>3])->first();
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth failed','data'=>null,'error'=>$e->getMessage()]);
        }


        try{
            $package=$this->photographerManager->deletePricingPackage($user,$request->pricingpackage_id);
            return response()->json(['status'=>200,'message'=>'Photographer\'s Pricing Package deleted successfully','data'=>$package]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }


}
