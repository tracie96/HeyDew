<?php

namespace App\Http\Controllers;

use App\SubscriptionModel;
use App\UserSubscription;
use Illuminate\Http\Request;

class iSubscriptionController extends Controller
{
    //


    public function addDummy(Request $request){
        try{

            $user=auth()->user();
            $user_subscriptions=new UserSubscription([
                'user_id'=>$user->id,
                'title'=>'Peexoo Subscription '.time(),
                'from_date'=>'2016-05-05',
                'due_date'=>'2016-06-05',
                'amount'=>8000,
                'is_active'=>true,
                'status'=>'ACTIVE',
                'type'=>'PEEXOO_MEMORIES']);

            //$user_subscriptions=UserSubscription::all();

            if(!$user_subscriptions->save()){
                return response()->json(['status'=>400,'message'=>'Failed to add Dummy Subscription','data'=>null]);
            }

            return response()->json(['status'=>200,'message'=>'Dummy Subscription added successfully','data'=>$user_subscriptions]);


        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Auth User not found','data'=>null,'error'=>$e->getMessage()]);
        }
    }

}
