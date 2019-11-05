<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerPortfolioImages extends Model
{
   // protected $appends = ['business_name'];
    //

    //
    //Types 1). PROFILE_COVER_IMAGES , 2). HOMEPAGE_SLIDER_IMAGES

    //Images are uploaded to S3, then url is saved to backend

    protected $fillable=['photographer_id','photographer_portfolio_category_key','image_url','is_active'];

    public function photographer(){
        return $this->belongsTo('App\Photographer');
    }
    // public function getBusinessNameAttribute() {
    //     $business_name = Photographer::where('user_id', auth()->id())->first();
    //     return $this;
    // }
}
