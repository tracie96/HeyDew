<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Payment;
use App\SubscriptionPlans;
use App\UserPayment;
use App\UserPaymentInstallments;
use App\UserSubscription;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    /**
     * @OA\GET(
     *     path="/api/subscription/charge/{subscription_plan_id}",
     *     tags={"subscription"},
     *     summary="Generates Payment for an authenticated user to a Subscription Object",
     *     operationId="requestPaymentForSubscription",
     *     @OA\Parameter(
     *         name="subscription_plan_id",
     *         in="path",
     *         description="Id of the Subscription to join",
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
    public function requestPaymentForSubscription(Request $request){
        //First, well confirm if the user exists,
        //Then, we'll confirm that the subscription exists
        //next, we'll generate a payment object for the user to pay for this subscription
        //Then we'll save it to User Payment and send an Invoice Mail
        //Then, Generate an Installmental Payment, but it should contain the full fee so that the user must pay once.

        //Verify User
        $user=null;
        try{
            $user=auth()->user();
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth User not found','data'=>null,'error'=>$e->getMessage()]);
        }

        if(!$user){
            return response()->json(['status'=>404,'message'=>'User does not exist`','data'=>null]);
        }

        //Verify Subscription plan exists
        $subscription=SubscriptionPlans::where(['id'=>$request->subscription_plan_id])->first();

        if(!$subscription){
            return response()->json(['status'=>404,'message'=>'Subscription does not exist`','data'=>null]);
        }

        //Generate Payment Object from paystack
        $payment=new Payment();
        $payment_object=$payment->chargeUser($user->email,$subscription->fee);

        //add to UserPayment for tracking
        $user_payment=new UserPayment([
            'user_id'=>$user->id,
            'title'=>"Payment for ".$subscription->title.' subscription',
            'type'=>'SUBSCRIPTION', //should have been table name, not type
            'payment_date'=>null,
            'amount'=>$subscription->fee,
            'object_id'=>$subscription->id,
            'object'=>json_encode($subscription),
            'meta'=>null
        ]);

        if(!$user_payment->save()){
            return response()->json(['status'=>400,'message'=>'Failed to add user payment','data'=>null]);
        }

        //Generate Installment Payment, but with full fee
        $full_installmental_payment=new UserPaymentInstallments([
            'userpayment_id'=>$user_payment->id,
            'amount'=>$subscription->fee,
            'payment_object'=>$payment_object.'',
            'payment_response'=>null,
            'gateway'=>'PAYSTACK']);
        if(!$full_installmental_payment->save()){
            return response()->json(['status'=>400,'message'=>'Failed to add user instalmental payment','data'=>null]);
        }
        //When the payment has been concluded via the payment url sent,
        //That's when the subscription is added. Not before!!

        $full_installmental_payment=UserPaymentInstallments::where(['id'=>$full_installmental_payment->id])->with('userpayment')->first();

        $full_installmental_payment['payment_object']=json_decode($full_installmental_payment['payment_object']);
        return response()->json(['status'=>200,'message'=>'User Payment successfully  created','data'=>$full_installmental_payment]);
    }

    /**
     * @OA\POST(
     *     path="/api/subscription/complete",
     *     tags={"subscription"},
     *     summary="This endpoint has to be hit by the payment gateway, but we'll make it open for testing purposes.",
     *     operationId="subscribeUser",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function subscribeUser(Request $request){
        //get all user's existing subscription
        $user=null;
        try{
            $user=auth()->user();
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth User not found','data'=>null,'error'=>$e->getMessage()]);
        }

        if(!$user){
            return response()->json(['status'=>404,'message'=>'User does not exist`','data'=>null]);
        }
        //Subscription plan of interest
        //Verify Subscription plan exists
        $subscription=SubscriptionPlans::where(['id'=>($request->subscription_plan_id=1)])->first();

        if(!$subscription){
            return response()->json(['status'=>404,'message'=>'Subscription does not exist`','data'=>null]);
        }

        //Does user have an active existing subscription plan for this package?
        $found_plans=UserSubscription::where(['subscription_package_id'=>$subscription->id,'user_id'=>$user->id,'is_active'=>true])->first();
        //to a given date.
        $date = new DateTime(date("Y-m-d"));

        //Create a new DateInterval object using P30D.
        $interval = new DateInterval("P".$subscription->duration."D");

        //Add the DateInterval object to our DateTime object.
        ;

        if($found_plans){
            $found_plan_due_date=new DateTime($found_plans->due_date);
            $difference=$found_plan_due_date->diff($date)->days;
                if($difference<0){
                    //So you've been doing awoof, abi. You've been ciught. We're deducting?
                }
                $increase=$subscription->duration+$difference;
            $interval = new DateInterval("P".($increase)."D");
            //make the xisting one outdated, since we'll be creating a new one
            $found_plans->update(['is_active'=>false,'status'=>'CARRYOVER']);
        }

        $new_user_subscription=new UserSubscription([
            'subscription_package_id'=>$subscription->id,
            'user_id'=>$user->id,
            'title'=>'Subscription for '.$subscription->title,
            'from_date'=>$date->format("Y-m-d"),
            'due_date'=>$date->add($interval)->format("Y-m-d"),
            'amount'=>$subscription->fee, //replace with the amount paystack sent
            'is_active'=>true,
            'status'=>'ACTIVE',
            'type'=>'NA']);

        if(!$new_user_subscription->save()){
            return response()->json(['status'=>404,'message'=>'Failed to save new user subscription','data'=>null]);
        }

        return response()->json(['status'=>200,'message'=>'Subscription added successfully','data'=>$new_user_subscription]);


    }


    /**
     * @OA\POST(
     *     path="/api/subscription/search",
     *     tags={"subscription"},
     *     summary="Searches for an authenticated user's subscriptions",
     *     operationId="getUserSubscriptions",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getUserSubscriptions(Request $request){
        try{
            $sort='asc';
            $start=0;
            $limit=100;
            $user=auth()->user();
            $user_subscriptions=UserSubscription::where(['user_id'=>$user->id]);

            if(isset($request->from_date)){

            }

            if(isset($request->due_date)){

            }

            if(isset($request->amount_range)){
                $min_max=explode(',',$request->amount_range);
            }

            if(isset($request->is_active)){

            }

            if(isset($request->type)){

            }


            if(!empty($request->sort)){
                if( ($request->sort==='asc') || ($request->sort==='desc') ) {
                    $sort = $request->sort;
                }
            }

            if(!empty($request->start)){
                $start=$request->start;
            }

            if(!empty($request->limit)){
                $limit=$request->limit;
                if($limit==='~'){
                    $limit=Transactions::max('id');
                }
            }

            $user_subscriptions=$user_subscriptions
                ->orderBy('id',$sort)
                ->offset($start)
                ->limit($limit);

            return response()->json(['status'=>404,'message'=>'Subscription search matches found','data'=>$user_subscriptions->get()]);

        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth User not found','data'=>null,'error'=>$e->getMessage()]);
        }
    }

    public function cancelSubscriptions(){

    }


    /**
     * @OA\PATCH(
     *     path="/api/subscription/package",
     *     tags={"subscription"},
     *     summary="Adds a new Subscription package",
     *     operationId="createSubscriptionPackage",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function createSubscriptionPackage(){

    }

}
