<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCategory extends Model
{
    //
    //Eg of Booking Category , Wedding, Portrait, Entertainment, Product
    protected $fillable=['id','title','display_image','is_active'];

}
