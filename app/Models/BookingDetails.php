<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    //
    protected $fillable=['booking_id','description','qty','unit_price'];

    public function test(){

    }
}
