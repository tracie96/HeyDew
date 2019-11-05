<?php


namespace App\UtilityModels\Notification;


use App\NotificationSettingsItem;
use App\NotificationSettingsType;
use Illuminate\Support\Facades\Log;

class NotificationManager
{

    public function getPhotographerNotifications(string $category,int $userId){
        $notifications=[];
        $notifications['default']=$this->getPhotographerNotificationsDefaults();
        return $notifications;
    }

    public function getPhotographerNotificationsDefaults(){
       return $notifications_types=NotificationSettingsType::select()->with('items')->get();
    }

    public function setupNotificationDefaults(){
        $notification_types=[];
        $notification_types[]=['title'=>"System Notifications",   'id_key'=>"N_SYS",'enabled'=>true];
        $notification_types[]=['title'=>"Message Notifications",  'id_key'=>"N_MSG",'enabled'=>true];
        $notification_types[]=['title'=>"Portfolio Notifications",'id_key'=>"N_PFL",'enabled'=>true];
        $notification_types[]=['title'=>"Booking Notifications",  'id_key'=>"N_BKN",'enabled'=>true];
        $notification_types[]=['title'=>"Payment Notifications",  'id_key'=>"N_PMT",'enabled'=>true];

        foreach( $notification_types as $notification){
            $n=NotificationSettingsType::where(['id_key'=>$notification['id_key']])->first();
            if($n){
               continue;
            }
            $n=new NotificationSettingsType($notification);
            $n->save();

            $items=[];
            $items[]=['notification_settings_type_key'=>$notification['id_key'],'item_key'=>$notification['id_key'].'_PSH','title'=>'Push','default'=>true];
            $items[]=['notification_settings_type_key'=>$notification['id_key'],'item_key'=>$notification['id_key'].'_EML','title'=>'Email','default'=>true];
            $items[]=['notification_settings_type_key'=>$notification['id_key'],'item_key'=>$notification['id_key'].'_SMS','title'=>'SMS','default'=>true];
            NotificationSettingsItem::insert($items);
        }



    }

//'status','type','title','description','user_id','archived'
    public function addNotification(string $title,string $description,string $type,int $user_id){

        Log::info("Created a Notification for user ".$user_id);

        //is user permitted to recieve this notification
        if($mobile=true){

        }

        if($email=true){

        }

        if($push_notifications=true){

        }

    }


}