<?php


namespace App\UtilityModels\Payment;


use App\Payment;
use App\UserPayment;

class PaymentManager
{



    public function getCardDetails(string $last6digits){
            $payment=new Payment();
          return $payment->getCardDetails($last6digits);
    }

    public function chargeCard($email,$amount){
        $payment=new Payment();
        return $payment->chargeUser($email,$amount);
    }

    public function addPaymentForUser(int $userId,float $charge_cost_amount,string $title,string $object,int $objectId){
        $user_payment=new UserPayment([
            'user_id'=>$userId,
            'title'=>$title,
            'type'=>$object,
            'payment_date'=>null,
            'amount'=>$charge_cost_amount,
            'eloquent_model'=>$object,
            'object_id'=>$objectId,
            'object'=>$object, //Eloquent Model for this charge
            'meta'=>null
        ]);
        if(!$user_payment->save()){
            throw new \Exception('Failed to add user payment',400);
        }
        return $user_payment;
    }


}