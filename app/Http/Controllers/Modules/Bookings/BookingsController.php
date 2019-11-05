<?php

namespace App\Http\Controllers\Modules\Bookings;

use App\BookingItems;
use App\Bookings;
use App\BookingType;
use App\Http\Controllers\Controller;
use App\Photographer;
use App\UserPayment;
use App\UtilityModels\Booking\BookingManager;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    //
    private $bookingManager;

    public function __construct(BookingManager $bookingManager)
    {
        $this->bookingManager=$bookingManager;
    }

    /**
     * @OA\POST(
     *     path="/api/bookings",
     *     tags={"bookings"},
     *     summary="adds a new Booking",
     *     operationId="addBookings",
     *     @OA\RequestBody(
     *         description="Booking Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),

     * )
     */
    public function addBookings(Request $request){
        try{
            $data=$this->bookingManager->addBooking(new Bookings($request->all()));
            return response()->json(['status'=>200,'message'=>'Bookings accepted successfully','data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/bookings/types",
     *     tags={"bookings"},
     *     summary="Fetch all bookings type bookings",
     *     operationId="listBookings",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function listBookingTypes(Request $request){
        $bookings=$this->bookingManager->getTypes();
        return response()->json(['status'=>200,'message'=>'Bookings fetched successfully','data'=>$bookings]);
    }

    /**
     * @OA\GET(
     *     path="/api/bookings/unfurl",
     *     tags={"bookings"},
     *     summary="Unfurl booking types ",
     *     operationId="unfurlBookingTypes",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function unfurlBookingTypes(Request $request){
        $bookings=$this->bookingManager->unfurlBookingTypes();
        return response()->json(['status'=>200,'message'=>'Bookings unfurled successfully','data'=>$bookings]);
    }

    /**
     * @OA\POST(
     *     path="/api/bookings/search/",
     *     tags={"bookings"},
     *     summary="Searches for {count} bookings",
     *     operationId="listBookings",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function searchBookings(Request $request){
        $bookings=Bookings::all()->offset($request->start)->take($request->count)->get();
        //filter by title

        //filter by type

        //filter by date range

        //filter by % amount paid range

        //filter by status [ongoing,pending,completed]

        //filter by photographer
        return response()->json(['status'=>200,'message'=>'Bookings fetched successfully','data'=>$bookings]);
    }


    /**
     * @OA\PATCH(
     *     path="/api/bookings/status",
     *     tags={"bookings"},
     *     summary="Searches for {count} bookings",
     *     operationId="listBookings",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateBookingStstus(Request $request){

        //isbooking acive?

        //if booking does not exist

        //if booking is completed, bounce

        //if booking is canceled, bounce

        //if booking is ongoing, next can be cancelled or completed

        //if pending, next can be ongoing or cancelled or completed

        //To complete, pay up outstanding fee, return payment (url the balance)


        //Can update status to completed here
//        $bookings=Bookings::first();
//        return response()->json(['status'=>200,'message'=>'Bookings fetched successfully','data'=>$bookings]);
    }

    public function cancel(){
        //return x% of deposit
    }

    /**
     * @OA\PUT(
     *     path="/api/bookings/album",
     *     tags={"bookings"},
     *     summary="adds a new album to booking",
     *     operationId="addAlbumToBooking",
     *
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function addAlbumToBooking(Request $request){
       try{
           $user=auth()->user();
       }catch (\Exception $e){

       }
       $albums=[];
        return response()->json(['status'=>200,'message'=>'Bookings fetched successfully','data'=>$albums]);
    }


    public function addAlbum(Bookings $bookings){
        //only if booking is accepted by user


    }

    public function addShoot(Bookings $bookings){
        //only if booking is accepted by user


    }

    /**
     * @OA\POST(
     *     path="/api/bookings/report/{who}",
     *     tags={"bookings"},
     *     summary="Allows a user to report a photographer for a booking",
     *     operationId="reportPhotographer",
     *
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function report(Request $request){
        //who is the person being reported
        //hope all parties are active and enabled
        $user=null;
        try{
            $user=\auth()->user();
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>'Unable to authenticate User','data'=>$e]);
        }
        //update booking review,
        //send notification to admin
        $photographer=Photographer::where(['id'=>1])->first();
        if(!$photographer){
            return response()->json(['status'=>404,'message'=>'Photographer with Id does not exist','data'=>null]);
        }
       return response()->json(['status'=>200,'message'=>'Report successful','data'=>mull]);
    }

    public function updateBookingCalendar(){
        //verify booking exists

        //verify it belongs to user

        //verify that it's still active

        //verify that it's not closed

        //update the shoot start and end dates

        //update the photographer's calendar
    }

    /**
     * @OA\PATCH(
     *     path="/api/bookings/{booking_id}/accept",
     *     tags={"bookings"},
     *     summary="Accepts a booking",
     *     operationId="acceptBooking",
     *     @OA\Parameter(
     *         name="booking_id",
     *         in="path",
     *         description="Id of the booking",
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
    public function acceptBooking(Request $request){
        try{
            $data=$this->bookingManager->acceptBooking($request->booking_id,'Mr Bankole\'s booking',1);
            return response()->json(['status'=>200,'message'=>'Bookings accepted','data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }
    }


    /**
     * @OA\PATCH(
     *     path="/api/bookings/{booking_id}/reject",
     *     tags={"bookings"},
     *     summary="Rejects a booking",
     *     operationId="rejectBooking",
     *     @OA\Parameter(
     *         name="booking_id",
     *         in="path",
     *         description="Id of the booking",
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
    public function rejectBooking(Request $request){
        try{
            $data=$this->bookingManager->rejectBooking($request->booking_id,1);
            return response()->json(['status'=>200,'message'=>'Bookings rejected','data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }
    }

    public function saveBookingsObjects(){
        //delete Existing Data
        //update all components
        //send Notifications
        //send Email

    }


    //POST
    public function cancelBooking(){
        //do verifications
        //make sure photographer is valid
        //make sure user is valid
        //set title
        //send emails
        //send Notifications

    }

    //POST
    public function addComment(){
        //do verifications
        //make sure photographer is valid
        //make sure user is valid
        //Sanitize comment
        //add Comment
        //new Comment($source:'Bookings', $message='text',$source='From',$to='To')

    }

    /**
     * @OA\POST(
     *     path="/api/bookings/images/search",
     *     tags={"bookings"},
     *     summary="Searches for images from bookings",
     *     operationId="searchImages",
     *     @OA\RequestBody(
     *         description="Booking images object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerSearchParams")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function searchImages(Request $request){
        try{
            $matches=$this->bookingManager->searchImages($request->all(),'asc',0,100);
            return response()->json(['status'=>200,'message'=>'Booking Images fetched successfully','data'=>$matches]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }
    }

}
