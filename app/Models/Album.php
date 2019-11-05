<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    public static $TYPE_FIND_MY_FACE='FIND_MY_FACE_ALBUM';
    public static $TYPE_PHOTOGRAPHER_COVER_IMAGE='PHOTOGRAPHER_COVER_IMAGE_ALBUM';
    public static $TYPE_PHOTOGRAPHER_HOMEPAGE_SLIDER_IMAGE='PHOTOGRAPHER_HOMEPAGE_SLIDER_IMAGE_ALBUM';
    public static $TYPE_USER_CREATED='USER_CREATED_ALBUM';
    public static $TYPE_SHARED_TO_USER='SHARED_RECIPIENT_ALBUM';
    public static $TYPE_PHOTOGRAPHER_PORTFOLIO_IMAGES='SHARED_RECIPIENT_ALBUM';
    public static $TYPE_PHOTOGRAPHER_PEEXOO_CLOUD='PEEXOO_CLOUD_ALBUM';

    protected $fillable=['title','email','type','archived','privacy','status','object_id','object','album_hash'];

    protected $casts=[
        'archived'=>'boolean'
    ];
    //source=['OWNER','CREATOR','SHARED']
    //status=['ACTIVE','ARCHIVED']
    //privacy =PUBLIC, INVITE, PRIVATE

    public static function createAlbum($title,$user_id){
        $album=new Album(['title'=>$title,'user_id'=>$user_id,'archived'=>false]);
        return $album->save();
    }

    public static function getUserAlbums($user_id,$start,$count,$sort){
        $albums=Album::where('user_id',$user_id)->where('archived',false)->orderBy('id',$sort)->offset($start)->limit($count) ->get();
        return $albums;
    }

    public function archiveAlbum($album_id){
        return Album::where('id',$album_id)->update('archived',true);
    }

    public function updateAlbumTitle($user_id,$album_id,$new_title){
        //Note this happens for album that are not archived
        return Album::where(['id'=>$album_id,'archived'=>false,'user_id'=>$user_id])->update('title',$new_title);
    }

    //share

    //sendLinkToEmails


}
