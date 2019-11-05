<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerPackage extends Model
{
    //

    protected $fillable=['photographerId','title','bookingTypeId','bookingPrice','is_active'];

    public function packageitems(){
        return $this->hasMany('App\PhotographerPackageItem','photographer_package_id','id');
    }
}


