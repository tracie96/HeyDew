<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentInstallments extends Model
{
    //
    protected $fillable=['userpayment_id','amount','payment_object','payment_response','gateway'];

    public function userpayment(){
        return $this->hasOne('App\UserPayment','id','userpayment_id');
    }
}
