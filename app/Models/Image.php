<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable=['category','category_source_id','image_url','archived','width','height'];

    //category = photographer cover images, category_source_id= photographer_id
    //category = album images, category_source_id= album_id
    //category = homepage slider images, category_source_id= photographer_id


    public static function addImage($gallery_id,$image_url){
        $image=new Image(['gallery_id'=>$gallery_id,'image_url'=>$image_url,'archived'=>false]);
        return $image->save();
    }

    public static function getGalleryImages($gallery_id){
        return Image::where('gallery_id',$gallery_id)->get();
    }

}
