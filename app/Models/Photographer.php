<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Photographer extends Model
{
    //
    use Searchable;
    protected $fillable=['user_id','region','business_name','photographers_type',
        'verified','archived','about_us','bvn','bvn_meta','bvn_verified','id_card','id_card_verified'];

    protected $casts=[
        'bvn_verified'=>'boolean',
        'id_card_verified'=>'boolean',
        'verified'=>'boolean',
        'archived'=>'boolean'
    ];

//    private $category;
//    private $photography_type;
//    private $region;
//    private $price_range;
//    private $availability_dates;


    public static function getPhotographerById($photographer_id){
        return Photographer::where(['id'=>$photographer_id,'archived'=>false])->first();
    }

    public static function banPhotographer($photographer_id){
        return Photographer::where('id',$photographer_id)->update(['archived',true]);
    }

    //features
    public function dashboard(){
       // return $this->hasMany('App\User','','user_id');
    }

    public function subscriptions(){
        return $this->hasMany('App\User','','user_id');
    }

    public function packages(){
        return $this->hasMany('App\PhotographerPackage','','user_id');
    }

    public function calendar(){ //billings

    }

    public function bookings(){
        return $this->hasMany('App\Bookings','photographer_id','id');
    }

    public function portfolio(){
        return $this->hasMany('App\PhotographerPortfolio','photographer_id','id');
    }   
    public function portfolioImages(){
        return $this->hasMany('App\PhotographerPortfolioImages','photographer_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function bankaccountdetails(){
        return $this->hasMany('App\PhotographerBankAccountDetails','photographer_id','id');
    }



    public function carddetails(){

    }



    public function photographer_type(){
        return $this->hasMany('App\PhotographerPortfolioCategoryApp','photographer_id','id');
    }

    public function payments(){ //billings

    }

    public function invoice(){ //billings

    }



    public function photographyCategoryInterests(){}


    public function isEligibleForSearch(){
//        return $this->([]);
    }

    public function pci(){
        return $this->hasMany('App\PhotographerPortfolioImages','photographer_id','id')->where(['photographer_portfolio_category_key'=>'PCI']);;
    }

    public function cinetype(){
        return $this->hasMany("App\PhotographerCineType",'photographer_id','id');
    }

}
