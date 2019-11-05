<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    //status= ONGOING...
    protected $fillable=['subscription_package_id','user_id','title','from_date','due_date','amount','is_active','status','type'];

    protected $casts=['is_active'=>'boolean'];

    public function payment(){
        return $this->hasOne('App\UserPayment','userpayment_id','id');
    }

    //
//Title,
//Subscription date,
//Subscription due date
//Current subscription: {
//Title, subdate, subdue_date
//}

//expiration_date;
//pricing_id

   // protected $fillable=['photographer_id','title','resumption_date','duration','expiration_date','charged_amount','status'];
    //subscription_type includes the one for photographers and users

}
