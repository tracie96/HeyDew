<?php


namespace App\UtilityModels\Photographer;


use App\Bookings;
use App\BookingType;
use App\Jobs\PhotographerAddedJob;
use App\Photographer;
use App\PhotographerBankAccountDetails;
use App\PhotographerBillingDetail;
use App\PhotographerCardDetails;
use App\PhotographerPortfolioCategory;
use App\PhotographerPortfolioImages;
use App\PhotographerProfileImages;
use App\User;
use App\UserNotificationSettings;
use App\UtilityModels\Calendar\CalendarManager;
use App\UtilityModels\Notification\NotificationManager;
use App\UtilityModels\ObjectManager;
use App\UtilityModels\Payment\PaymentManager;
use App\UtilityModels\User\UserManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class PhotographerManager extends ObjectManager
{
    private $userManager;
    private $photographerNotification;
    private $paymentManager;
    private $calendarManager;
    private $cardManager;
    private $pricingPackageManager;
    public function __construct(UserManager $userManager,NotificationManager $notificationManager,PaymentManager $paymentManager,CalendarManager $calendarManager,
                                PhotographerATMCardManager $cardManager,PhotographerPricingPackageManager $pricingPackageManager)
    {
        $this->userManager=$userManager;
        $this->photographerNotification=$notificationManager;
        $this->paymentManager=$paymentManager;
        $this->calendarManager=$calendarManager;
        $this->cardManager=$cardManager;
        $this->pricingPackageManager=$pricingPackageManager;
    }

    public function getPhotographerProfileImages(int $photographer_id, string $category){
        $photographer=$this->getPhotographerById($photographer_id);

        //verify photographer profile category exists
        if($category==='HPSI_RND'){
            $category='HPSI';
            $this->ProfileCategoryIsActive($category);
            $images=PhotographerPortfolioImages::where(['photographer_portfolio_category_key'=>$category,'is_active'=>true])
                ->orderBy(DB::raw('RAND()'))->take(10)
                ->select('image_url')->get();
            return $images;
        }

        $this->ProfileCategoryIsActive($category);

        $images=PhotographerPortfolioImages::where(['photographer_id'=>$photographer->id,'photographer_portfolio_category_key'=>$category,'is_active'=>true])->select('image_url')->get();

        return $images;
    }

    public function getPortfolioImages(int $photographer_id, string $category){

        // $this->addPhotographerImage()

        $photographer=$this->getPhotographerById($photographer_id);

        //verify photographer portfolio category exists

        $this->BookingTypeIsActive($category);
        $images=PhotographerPortfolioImages::where(['photographer_id'=>$photographer->id,'photographer_portfolio_category_key'=>$category,'is_active'=>true])->select('image_url')->get();

        return $images;
    }


    public function getRandomPhotographerHPSIImages(int $count){

            $images=PhotographerPortfolioImages::where(['photographer_portfolio_category_key'=>'HPSI','is_active'=>true])
                ->orderBy(DB::raw('RAND()'))->take($count)
                ->select('image_url','photographer_id')->get();  
            foreach ($images as $image) {
               $business_name =Photographer::find($image->photographer_id)->business_name; 
               $image->business_name = $business_name;
            }                 
            return $images;

    }

    public function addPhotographerImages(User $user,array $imageUrl,string $category):array{

        $this->userManager->accountActive($user);
        $photographer=$this->getPhotographerByUserId($user->id);

        try {
            $this->ProfileCategoryIsActive($category);
        }catch (\Exception $e){
            $this->BookingTypeIsActive($category);
        }

        $time=Carbon::now()->format("Y-m-d H:i:s");

        $insert_load=[];
        foreach ($imageUrl as $key=>$image){
            $insert_load[$key]['created_at']=$time;
            $insert_load[$key]['updated_at']=$time;
            $insert_load[$key]['photographer_portfolio_category_key']=$category;
            $insert_load[$key]['photographer_id']=$photographer->id;
            $insert_load[$key]['is_active']=true;
            $insert_load[$key]['image_url']=$image;
        }

        if(!PhotographerPortfolioImages::insert($insert_load)){
            throw new \Exception('Failed to save Image',400);
        }

        return $imageUrl;
    }

    public function photographerEnabled(Photographer $photographer){
        if($photographer->archived){
         //   throw new \Exception('Photographer is archived',400);
        }
        if(!$photographer->verified){
          //  throw new \Exception('Photographer is not verified',400);
        }

        if(!$photographer->bvn_verified){
            //  throw new \Exception('Photographer is not verified',400);
        }

        if(!$photographer->id_card_verified){
            //  throw new \Exception('Photographer is not verified',400);
        }

        return true;
    }

    public function getPhotographerById(int $photographerId){
        $photographer=Photographer::where(['id'=>$photographerId])->first();
        if(!$photographer){
            throw new \Exception('Photographer with Id does not exist',404);
        }

        $this->photographerEnabled($photographer);

        return $photographer;
    }

    public function getPhotographerByUserId(int $userId){
        $photographer=Photographer::where(['user_id'=>$userId])->first();
        if(!$photographer){
            throw new \Exception('Photographer with user_Id does not exist',404);
        }

        $this->photographerEnabled($photographer);

        return $photographer;
    }

    public function updatePhoneNumber(Photographer $photographer){
        $this->photographerEnabled($photographer);
        $user=User::where(['id'=>$photographer->user_id])->first();
        $this->userManager->updatePhoneNumber($user);
    }

    public function sendPhoneUpdateOTP(){
      return  $this->userManager->sendPhoneUpdateOTP();
    }

    public function updateEmailAddress(){
     return   $this->userManager->updateEmailAddress();
    }

    public function updatePassword(){
      return  $this->userManager->updatePassword();
    }

    public function deactivateAccount(){
     return   $this->userManager->deactivateAccount();
    }

    public function updateNotification(User $user,UserNotificationSettings $notificationSettings){
     return $this->userManager->updateNotification($user,$notificationSettings);
    }

    public function updateBankDetails(Photographer $photographer,PhotographerBankAccountDetails $bankAccountDetails){
        $user=User::where(['id'=>$photographer->user_id])->first();
        $this->userManager->accountActive($user);
        $this->photographerEnabled($photographer);
        ////
    }

    public function updateBillingAddress(PhotographerBillingDetail $billingDetail){

    }

    public function addCardDetails(PhotographerCardDetails $cardDetails){

    }

    public function updateCardDetails(PhotographerCardDetails $cardDetails){

    }

    public function getBookingsToPhotographer(Photographer $photographer,$start,$limit,$order){

    }

    public function getBookingsToPhotographerWithinDateRange(Photographer $photographer,\DateTime $startDate,\DateTime $endDate,$categories,$countries,$state){

    }

    public function getPaymentsToPhotographerWithinDateRange(Photographer $photographer,\DateTime $startDate,\DateTime $endDate,$categories,$countries,$state){
        //return bookings paid within daterange

        //return findmyface earned within daterange
    }

    public function getCustomersWithinDateRange(Photographer $photographer,\DateTime $startDate,\DateTime $endDate,$categories,$countries,$state){
        //return uniques customers from bookings within daterange

        //return findmyface customers from bookings within daterange

    }

    public function getPortfolioWithinDateRange(Photographer $photographer,\DateTime $startDate,\DateTime $endDate,$categories,$countries,$state){
        //return portfolio views

        //return likes within daterange
    }

    public function getNotifications(int $user_id){
      $this->photographerNotification->setupNotificationDefaults();
       return $this->photographerNotification->getPhotographerNotifications("ALL",$user_id);

    }


    public function ProfileCategoryIsActive(string $key){
        $portfolio_images=PhotographerPortfolioCategory::where(['category_key'=>$key])->first();

        if(!$portfolio_images){
            throw new \Exception('Profile Category does not exist',404);
        }

        if(!$portfolio_images->active){
            throw new \Exception('Profile Category is deactivated',400);
        }

    }

    public function BookingTypeIsActive(string $key){

        $portfolio_images=BookingType::where(['key_code'=>$key])->first();

        if(!$portfolio_images){
            throw new \Exception('BookingType does not exist',404);
        }

        if(!$portfolio_images->is_active){
            throw new \Exception('BookingType is deactivated',400);
        }

    }

    public function getUserByPhotographerId(int $photographerId){

    }

    public function addCalendarEvent(int $user_id,string $start_date,string $end_date,string $description,string $parent_object,int $parent_object_id){
      $photographer=$this->getPhotographerByUserId($user_id);
      return  $this->calendarManager->addDate($user_id,$start_date,$end_date,$description,$parent_object,$parent_object_id);
    }

    public function getUserCalendarEvents(int $photographer_id,string $startDate,string $endDate,int $limit){
      $photographer=$this->getPhotographerById($photographer_id);
      return $this->calendarManager->getUserCalendarEvents($photographer->user_id,$startDate,$endDate,$limit);
    }

    public function getPhotographerCardDetails(int $photographer_id){
            $photographer=$this->getPhotographerById($photographer_id);
           return $this->cardManager->getPhotographerATMCards($photographer->user_id);
    }

    public function addPhotographerCardDetails(int $photographer_id,array $cardDetails){
        $photographer=$this->getPhotographerById($photographer_id);
        $user=$this->userManager->getUserById($photographer->user_id);
        $card_number=$cardDetails['card_number'];
        $length=strlen($card_number);
        return $this->cardManager->addCardDetails($photographer->user_id,$cardDetails);
    }

    public function addBillingAddress(int $photographer_id,array $billingDetails){

    }

    public function getBillingAddresses(){

    }

    public function addUserToPhotographer($user,$about_us,$category,$photography_type,$region,$business_name){


        if(empty($business_name)){
            throw new \Exception('Please provide a business name',400);
        }
       // $photographer=$this->getPhotographerByUserId($user->id);
       // $user=$this->getUserByPhotographerId($photographer->id);

        $photographer=Photographer::where('user_id',$user->id)->first();

        if($photographer){
            throw new \Exception('User has already joined',400);
        }
// Where we create a photographer

        $photographer=new Photographer(['user_id'=>$user->id,'verified'=>false,'archived'=>false,'about_us'=>$about_us,
            'region'=>$region,'business_name'=>$business_name,
            'bvn'=>null,'bvn_meta'=>null,'bvn_verified'=>false,'id_card'=>null,'id_card_verified'=>false
        ]);

        if(!$photographer->save()){
            throw new \Exception('Failed to add Photographer',400);
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
        return $photographer;

    }


    public function addPricingPackage(User $user,string $title,int $bookingTypeId,float $cost,array $items){
        $photographer=$this->getPhotographerByUserId($user->id);
        $user=$this->userManager->getUserById($user->id);
        //verify booking_id
        return $this->pricingPackageManager->addPricingPackage($photographer->id,$title,$bookingTypeId,$cost,$items);
    }

    public function deletePricingPackage(User $user,int $pricingPackageId){
        $photographer=$this->getPhotographerByUserId($user->id);
        $user=$this->userManager->getUserById($user->id);
        return $this->pricingPackageManager->deletePhotographerPricingPackage($photographer->id,$pricingPackageId);
    }

    public function getPhotographerCategories(int $photographer_id){
        $photographer=$this->getPhotographerById($photographer_id);
        //$this->addBookingTypes([]);
        $booking_types=BookingType::select()->get();

        foreach ($booking_types as $key=>$value){
            if(!isset($booking_types[$key]['images'])){
                $booking_types[$key]['images']=[];
            }
            $imagel=PhotographerPortfolioImages::where(['photographer_id'=>$photographer->id,'photographer_portfolio_category_key'=>$booking_types[$key]['key_code']])->select(['image_url'])->get();
            $booking_types[$key]['images']=$imagel;
        }
        return $booking_types;
    }

    public function searchPhotographers(array $searchParams,string $sortOrder='asc',int $start=0,int $end=20){
        //categories
        //photographer type
        //region
        //availability dates range
        //price range
        $photographers_match=Photographer::select();

        $categories=[];
        if(isset($searchParams['categories']))
        $categories=explode(',',$searchParams['categories']);
        if(count($categories)>0){
            $photographers_match->orWhereIn('id',function ($t) use($categories){
                $t->select(DB::raw("photographer_id from photographer_portfolio_images "))->whereIn('photographer_portfolio_category_key',$categories);
            });
        }

        $type=[];
        if(isset($searchParams['type']))
        $type=explode(',',$searchParams['type']);
        if(count($type)>0){
            $photographers_match->orWhereIn('id',function ($t) use($type){
                $t->select(DB::raw("photographer_id from photographer_cine_types "))->whereIn('type',$type);
            });
        }

        $region=[];
        if(isset($searchParams['region']))
        $region=explode(',',$searchParams['region']);
        if(count($region)>0){
            $photographers_match->whereIn('region',$region);
        }

        $availability=[];
        if(isset($searchParams['availability']))
        $availability=explode(',',$searchParams['availability']);
        if(count($availability)>0){
        }

        $price=[];
        if(isset($searchParams['price']))
        $price=explode(',',$searchParams['price']);
        if(count($price)>0){
        }

        //$photographers_match=DB::select(DB::raw('select * from `photographers` where photographers.region in  ('.implode($region).')' ));//where ( photographers.id in (select photographer_id from `bookings`)) '));
          $photographers_match=$photographers_match->offset($start)->limit($end)->orderBy('id',$sortOrder)->with('pci')->with('cinetype')->get();

        //todo: update search params
        return $photographers_match;
    }


}