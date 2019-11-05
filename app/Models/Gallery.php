<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //

    protected $fillable=['title','description','user_id','archived'];

    public static function createGallery($title,$description,$user_ownerid){
            $gallery=new Gallery([
                'title'=>$title,
                'description'=>$description,
                'user_id'=>$user_ownerid,
                'archived'=>false
            ]);
            return $gallery->save();
    }

    public static function getUserGalleries($user_id){
       return Gallery::where(['user_id'=>$user_id,'archived'=>false])->get();
    }


    public static function addImageToGallery($gallery_id,$image_url){
       return Image::addImage($gallery_id,$image_url);
    }

    public static function getImagesFromGallery($gallery_id){
        return Image::getGalleryImages($gallery_id);
    }




}
