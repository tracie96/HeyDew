<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingType extends Model
{
    //
    protected $fillable=['title','display_image','display_icon','caption',"key_code",'is_active'];


}
