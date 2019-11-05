<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{

    public static $PAYMENT_TYPE_BOOKING="BOOKING_PAYMENT";
    //
    public static $STATUS_PENDING='PENDING';
    public static $STATUS_ONGOING='ONGOING';
    public static $STATUS_COMPLETED='COMPLETED';

    protected $fillable=['user_id','title','type','payment_date','amount','eloquent_model','object_id','object','meta'];

    protected $casts=['object' => 'boolean',];

    public function installments(){
        return $this->hasMany('App\UserPaymentInstallments','userpayment_id','id');
    }


}
