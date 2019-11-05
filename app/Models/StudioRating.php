<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudioRating extends Model
{
    //

    protected $fillable=['studio_id','user_id','rating','comment'];
    public static function rateStudio($studio_id,$user_id,$rating){
        $studio_rating=new StudioRating(['studio_id','user_id','rating','comment']);
        return $studio_rating->save();
    }

    public static function getStudioRating($studio_id,$start,$count,$sort){
        return StudioRating::where('studio_id',$studio_id)->get();
    }

    public static function getUserStudioRating($user_id){
        return StudioRating::where('user_id',$user_id)->get();
    }

}
