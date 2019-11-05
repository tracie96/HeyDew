<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Unicodeveloper\Paystack\Paystack;

class Payment extends Model
{
    //composer require unicodeveloper/laravel-paystack

    //https://dev.to/ijsucceed/how-to-integrate-paystack-payment-system-with-php-5a8m

    private $headers=[
        "authorization"=>"Bearer ", //replace this with your own test key
        "content-type"=>"application/json",
        "cache-control"=>"no-cache"
    ];

    public function chargeUser($email,$amount,$callback_url=''){
        $this->headers['authorization']="Bearer sk_test_246e392e398e5b001dca2fad490db6afd53350c2".env('PAYSTACK_SK_KEY');
        Log::info($this->headers);
        $curl = new Client([
            'base_uri'=>'https://api.paystack.co',
            'headers' => $this->headers,
            'form_params'    => [
                'amount'=>$amount*100,
                'email'=>$email,
                'callback_url' => '',
//                'file'=>'/path/to/file/file.file'
            ],
            'timeout' => 10
            ]);

       $tranx = $curl->post('/transaction/initialize');
        //return $curl->getConfig();

       return $tranx->getBody();
       echo $tranx['data']['authorization_url'];
//
    }

    public static function getUserPayments($user_id,$start,$limit,$sort){

    }

    public static function getPayments($start,$limit,$sort){

    }

    public function verifyPayment($reference){
        $this->headers['authorization']="Bearer ".env('PAYSTACK_SK_KEY');
        $curl = new Client([
            'base_uri'=>'https://api.paystack.co',
            'headers' => $this->headers,
            'timeout' => 10
        ]);


        $tranx = $curl->get('/transaction/verify/' . rawurlencode($reference));
        //return $curl->getConfig();

        return $tranx->getBody();
        echo $tranx['data']['authorization_url'];

        if(!$tranx->status){
            // there was an error from the API
            die('API returned error: ' . $tranx->message);
        }

        if('success' == $tranx->data->status){
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
            echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>";
        }

    }

    public function verifyBVN($bvnCode){
        $this->headers['authorization']="Bearer ".env('PAYSTACK_SK_KEY','sk_test_246e392e398e5b001dca2fad490db6afd53350c2');
        $curl = new Client([
            'base_uri'=>'https://api.paystack.co',
            'headers' => $this->headers,
            'timeout' => 10
        ]);

        $tranx = $curl->get('/bank/resolve_bvn/' . $bvnCode . '');

        //return $curl->getConfig();

        return $tranx->getBody();
    }

    public function getCardDetails($last6pin){
        //        curl "https://api.paystack.co/decision/bin/539983" \
//        -H "Authorization: Bearer YOUR_SECRET_KEY" \
//        -X GET
        $this->headers['authorization']="Bearer ".env('PAYSTACK_SK_KEY','sk_test_246e392e398e5b001dca2fad490db6afd53350c2');
        $curl = new Client([
            'base_uri'=>'https://api.paystack.co',
            'headers' => $this->headers,
            'timeout' => 10
        ]);


        $tranx = $curl->get('/decision/bin/'.$last6pin.'');
        //return $curl->getConfig();

        return $tranx->getBody();
    }


}
