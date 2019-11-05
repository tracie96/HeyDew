<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerBillingDetail extends Model
{
    //
    protected $fillable=['photographer_id','firstname','lastname','country','state','city','postal_code','address'];
}
