<?php

namespace App\Http\Controllers\Modules\Notifications;

use App\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function getUserNotifications(){
        $notifications=Notifications::where()->get();
        $chat_notifications=[];
        $jobs_notifications=[];
        $invoice_notifications=[];
        $lists=[];
        return response()->json(['status'=>200,'message'=>'Notifications fetched successfully','data'=>$lists]);
    }


}
