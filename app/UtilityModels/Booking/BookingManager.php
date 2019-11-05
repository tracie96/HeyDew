<?php


namespace App\UtilityModels\Booking;


use App\BookingImages;
use App\BookingItems;
use App\Bookings;
use App\BookingType;
use App\NotificationSettingsItem;
use App\Photographer;
use App\UtilityModels\Calendar\CalendarManager;
use App\UtilityModels\Notification\NotificationManager;
use App\UtilityModels\Payment\PaymentManager;
use App\UtilityModels\Photographer\PhotographerManager;
use App\UtilityModels\User\UserManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingManager
{

    private $calendarManager;
    private $photographerManager;
    private $userManager;
    private $notificationSettingsItem;
    private $notificationManager;
    private $paymentManager;

    public function __construct(CalendarManager $calendarManager,PhotographerManager $photographerManager,UserManager $userManager,
                                NotificationSettingsItem $notificationSettingsItem,NotificationManager $notificationManager,
                                PaymentManager $paymentManager)
    {
        $this->calendarManager=$calendarManager;
        $this->photographerManager=$photographerManager;
        $this->userManager=$userManager;
        $this->notificationSettingsItem=$notificationSettingsItem;
        $this->notificationManager=$notificationManager;
        $this->paymentManager=$paymentManager;
    }

    public function addBooking(Bookings $booking){

        $photographer=$this->photographerManager->getPhotographerById($booking->photographer_id);

        $photographer_user=$this->userManager->getUserById($photographer->user_id);

        $user=$this->userManager->getUserById($booking->user_id);

        $today=Carbon::now();

        $shoot_start_date=\DateTime::createFromFormat("Y-m-d",$booking->shoot_start_date);

        $shoot_end_date=\DateTime::createFromFormat("Y-m-d",$booking->shoot_end_date);

        $delivery_date=\DateTime::createFromFormat("Y-m-d",$booking->delivery_date);

        if(!$shoot_start_date ){
            throw new \Exception('Invalid Start Date. Expecting Y-m-d',400);
        }

        if($shoot_start_date->format("Y-m-d")!=$booking->shoot_start_date){
            throw new \Exception('Invalid Start Date value.',400);
        }

        if(!$shoot_end_date){
            throw new \Exception('Invalid End Date. Expecting Y-m-d',400);
        }

        if($shoot_end_date->format("Y-m-d")!=$booking->shoot_end_date){
            throw new \Exception('Invalid End Date value. Expecting Y-m-d',400);
        }

        if(!$delivery_date){
            throw new \Exception('Invalid Delivery Date. Expecting Y-m-d',400);
        }

        if($delivery_date->format("Y-m-d")!=$booking->delivery_date){
            throw new \Exception('Invalid Delivery Date value. Expecting Y-m-d',400);
        }

        if($today>$shoot_start_date){
            throw new \Exception('Current Date is ahead of Start date',400);
        }


        if($shoot_start_date>$shoot_end_date){
            throw new \Exception('Start date is ahead of End date',400);
        }

        if($shoot_end_date>$delivery_date){
            throw new \Exception('End date is ahead of Delivery date',400);
        }


        $calendarEvents=$this->calendarManager->getUserCalendarEvents($photographer->user_id,''.$booking->shoot_start_date,''.$booking->shoot_end_date,100);

        if(count($calendarEvents)>0){
            throw new \Exception('There are occupied dates for this booking',400);
        }

        $booking['status']=Bookings::$STATUS_PENDING;

        if(!$booking->save()){
            throw new \Exception('Failed to add booking',400);
        }


        $items=[];
        $items[]=['title'=>'Pre wedding','quantity'=>5,'cost'=>75000,'active'=>true];
        $items[]=['title'=>'Traditional wedding','quantity'=>3,'cost'=>100000,'active'=>true];
        $items[]=['title'=>'Court wedding','quantity'=>2,'cost'=>35000,'active'=>true];


        $this->addBookingItems($booking->id,$booking->items=$items);

//        $this->paymentManager->chargeCard();//save Payment

//        $this->calendarManager->addDate('','','','','','');

        //to user
        $this->notificationManager->addNotification('New Booking created','','INFO',$booking->user_id);

        //to photographer
        $this->notificationManager->addNotification('New Booking for you','','JOB',$photographer->user_id);

        $booking=Bookings::where(['id'=>$booking->id])->with("items")->first();
        return $booking;
    }

    public function addBookingItems(int $bookingId,array $items){
        $date_now=date("Y-m-d H:i:s");
        foreach ($items as $key=>$item){
            $items[$key]['created_at']=$date_now;
            $items[$key]['updated_at']=$date_now;
            $items[$key]['booking_id']=$bookingId;
        }
        return $reponse=BookingItems::insert($items);
    }

    public function acceptBooking(int $booking_id,string $title,int $photographer_id){


        $photographer=$this->photographerManager->getPhotographerById($photographer_id);

        $photographer_user=$this->userManager->getUserById($photographer->user_id);

        $booking=$this->getBookingById($booking_id);

        if($booking->photographer_id != $photographer_id){
            throw new \Exception('Booking Photographer id mismatch',400);
        }

        if($booking->status === 'ONGOING'){
            throw new \Exception('Booking is ongoing',400);
        }

        if($booking->status === 'CANCELED'){
            throw new \Exception('Booking has been rejected',400);
        }

        if($booking->status === 'COMPLETED'){
            throw new \Exception('Booking is completed',400);
        }

        $user=$this->userManager->getUserById($booking->user_id);

        if(empty($title)){
            throw new \Exception('No value found for title',404);
        }

        if(strlen($title)>30){
            throw new \Exception('Title must be less than 30 characters',404);
        }

        if(!$booking->update(['title'=>$title,'status'=>'ONGOING'])){
            throw new \Exception('Failed to set Booking\'s title',400);
        }

        $cost=$this->getBookingCost($booking->id);

        $this->paymentManager->addPaymentForUser($user->id,$cost,"Payment for Booking ".$title."","BOOKING",$booking->id);

        $this->calendarManager->addDate($photographer_user->id,$booking->shoot_start_date,$booking->shoot_end_date,$title,"BOOKING",$booking_id);

        $this->notificationManager->addNotification('Booking accepted','','INFO',$photographer_user->id);

        $this->notificationManager->addNotification('Your Booking request has been accepted','','INFO',$user->id);

        return $booking;
    }

    public function rejectBooking(int $booking_id,int $photographer_id){
        $photographer=$this->photographerManager->getPhotographerById($photographer_id);

        $photographer_user=$this->userManager->getUserById($photographer->user_id);

        $booking=$this->getBookingById($booking_id);

        if($booking->photographer_id != $photographer_id){
            throw new \Exception('Booking Photographer id mismatch',400);
        }

        if($booking->status === 'ONGOING'){
            throw new \Exception('Booking is ongoing',400);
        }

        if($booking->status === 'CANCELED'){
            throw new \Exception('Booking has been rejected',400);
        }

        if($booking->status === 'COMPLETED'){
            throw new \Exception('Booking is completed',400);
        }

        $user=$this->userManager->getUserById($booking->user_id);



        if(!$booking->update(['status'=>'CANCELED'])){
            throw new \Exception('Failed to reject booking',400);
        }

//        $this->calendarManager->removeDate()

//        $this->paymentManager->

        $this->notificationManager->addNotification('Booking rejected','','INFO',$photographer_user->id);

        $this->notificationManager->addNotification('Your Booking request has been rejected','','INFO',$user->id);


    }

    public function getBookingById(int $id){
        $booking= Bookings::where(['id'=>$id])->first();

        if(!$booking){
            throw new \Exception('Booking with id does not exist',404);
        }

        return $booking;
    }

    public function getBookingCost(int $bookingId){
        return BookingItems::where(['booking_id'=>$bookingId])->sum("cost");
    }

    public function getTypes(){
        return BookingType::select()->where(['is_active'=>true])->get();
    }

    public function unfurlBookingTypes(array $types=[]){
        $now=Carbon::now()->format('Y:m:d H:i:s');
        $types=[
            ['title'=>'Wedding','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Wedding Caption","key_code"=>"WDNG",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Event','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Event Caption","key_code"=>"EVNT",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Product','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Product Caption","key_code"=>"PRDCT",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Real Estate','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Real Estate Caption","key_code"=>"RLEST",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],

            ['title'=>'Portrait','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Portrait Caption","key_code"=>"POTR",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Family','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Family Caption","key_code"=>"FMLY",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Babies','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Babies Caption","key_code"=>"BBS",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Corporate','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Corporate Caption","key_code"=>"COPT",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],

            ['title'=>'Landscape','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Landscape Caption","key_code"=>"LNDS",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Architectural','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Architectural Caption","key_code"=>"ARCH",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['title'=>'Interior','display_image'=>'emptyimage.png','display_icon'=>'emptyicon.png','caption'=>"Interior Caption","key_code"=>"INTR",'is_active'=>1,'created_at'=>$now,'updated_at'=>$now],
         ];
        foreach ($types as $key=>$value){

        }
        return BookingType::insert($types);
    }



    public function searchImages(array $params,$sort='asc',$start=0,$limit=100){

        $categories=explode(',',$params['categories']);
        $shoot_types=explode(',',$params['shoot_types']);
        $shoot_regions=explode(',',$params['shoot_regions']);


        $shoot_dates=explode(',',$params['shoot_dates']);
        $shoot_dates_start=$shoot_dates[0];
        $shoot_dates_end=$shoot_dates[1];

        $search_text=$params["search_text"];

        $matching_bookings=Bookings::whereIn('booking_category_id',$categories)
            ->whereIn('type',$shoot_types)
            ->whereIn('state',$shoot_regions)

            ->whereDate('shoot_start_date','>=',$shoot_dates_start)
            ->whereDate('shoot_end_date','<=',$shoot_dates_end)

            ->whereIn('search_text',$search_text)
            ->with('images')->pluck(['id']);

        $matching_booking_images=BookingImages::whereIn('booking_id',$matching_bookings)->get();
        //Inner join should work best here


    }

}