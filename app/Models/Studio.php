<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    //

    protected $fillable=['title','address','description','rating','status','archived'];

    public static function addStudio($title,$address,$description,$rating,$status){
        $studio=new Studio([
            'title'=>$title,
            'address'=>$address,
            'description'=>$description,
            'rating'=>$rating,
            'status'=>$status,
            'archived'=>false
        ]);
        return $studio->save();
    }

    public static function updateStudio($studio_id,$title,$address,$description){
        return Studio::where('id',$studio_id)->update(['title'=>$title,'address'=>$address,'description'=>$description]);
    }

    public static function banStudio($studio_id){
        return Studio::where('id',$studio_id)->update(['archived'=>true]);
    }

    public static function rateStudio($studio_id,$user_id,$rating){
        //add to studion rating model
        return StudioRating::rateStudio($studio_id,$user_id,$rating);
    }

    public static function getStudioRating($studio_id){
        return StudioRating::getStudioRating($studio_id);
    }

    public static function updateStudioStatus($studio_id,$status){
        return Studio::where('id',$studio_id)->update(['status'=>$status]);
    }



}
