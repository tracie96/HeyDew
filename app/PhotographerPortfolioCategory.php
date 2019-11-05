<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerPortfolioCategory extends Model
{
    //
    protected $fillable=['title','category_key','active'];
    protected $casts=[
        'active'=>'boolean'
    ];

    public function portfolioimages(){ //Images that are in the Profile Category and HomePageSlider

    }

    public function categoryimages(){ //Images in categories
        return $this->hasMany('App\PhotographerPortfolioImages','photographer_portfolio_category_key','category_key');
    }

}
