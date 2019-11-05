<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //

    const NOTIFICATION_INVOICE='';
    const NOTIFICATION_JOBS='';
    const NOTIFICATION_INFO='';
    const NOTIFICATION_CHAT='';


    protected $fillable=['status','type','title','description','user_id','archived'];

    public static function addNotifications($to_user,$title,$type,$description){
        $notification=new Notifications([
            'status'=>'open',
            'type'=>$type,
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$to_user,
            'archived'=>false
        ]);
        return $notification->save();
    }

    public static function getUserNotifications($user_id,$type,$start,$count,$sort){
        return Notifications::where('user_id',$user_id)->get();
    }

    public static function updateArchived($notification_ids){
        return Notifications::whereIn('id',$notification_ids)->update(['archived'=>true]);
    }



}
