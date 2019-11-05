<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{

    public static $BOOKING_TYPE_A;

//Ongoing, pending, canceled, completed

    public static $STATUS_ONGOING='ONGOING';
    public static $STATUS_PENDING='PENDING';
    public static $STATUS_CANCELED='CANCELED';
    public static $STATUS_COMPLETED='COMPLETED';

    //Booking Type ='USER_ADDED_SCHEDULE'

    //Eg of Booking Category , Wedding, Portrait, Entertainment, Product

    protected $fillable=['user_id','photographer_id','booking_category_id','title','extra_message','country','state','address1','address2','type',
        'shoot_start_date','shoot_end_date','delivery_date','status','review','review_date','rating','package_name'];

    protected $table='bookings';

    //

//title

//Firstname,
//Lastname,
//Phone_number,
//Email,

//user_id


//Photographer_name,

//photographer_id

//Country,
//State,
//Address

//Type of service, (shoot_type)
//Shoot start date,
//Shoot end date,
//Other_instructions, (extra_text)

//shoot_calendar

//Shoot_details: [
//{description, quantity and amount}
//]
//Total,
//Payment made (% amount and amount )
//Balance (% amount and amount)
//Delivery date
//status = Ongoing, pending, canceled, completed


//Also, a non-fixed amount can be paid for an album

//when canceling booking, refund x%

//report Booking (report has text and index)

//booking deliver date (Expected delivery date for bookings shoot)

    public function photographertype(){
        //return $this->hasMany('App\Payments','booking_id','id');
    }

    public function calendar(){
       // return $this->hasMany('App\Payments','booking_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function payments(){
        //bookings.getPayments
        return $this->hasOne('App\UserPayment','object_id','id')->where(['eloquent_model'=>'BOOKINGS']);
    }

    public function bookinginvoice(){
        //bookings.getPayments
        // return $this->hasMany('App\BookingInvoice','invoice_id','booking_id');
    }

    public function albums(){
        //bookings.getAlbums
        return $this->hasMany('App\Albums','object_id','id');
    }

    public function bookingdetails(){
         return $this->hasMany('App\BookingDetails','booking_id','id');
//         BookingObjects
    }

    public function items(){
        return $this->hasMany('App\BookingItems','booking_id','id');
//         BookingObjects
    }

    public function photographer(){
        return $this->hasOne('App\Photographer','id','photographer_id');
    }

    public function category(){
        return $this->hasOne('App\BookingCategory','id','booking_category_id');
    }

}
