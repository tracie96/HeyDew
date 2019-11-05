<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    //
    protected $fillable=['user_id','firstname','lastname','country','state','city','postal_code','address'];
    protected $casts=[];
}
