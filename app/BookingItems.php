<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingItems extends Model
{
    //
    protected $fillable=['booking_id','title','quantity','cost','active'];
}
