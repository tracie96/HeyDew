<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerCardDetails extends Model
{
    //Photographer's card details which would be used to deduct mandatory fees

    protected $fillable=['photographer_id','first_name','last_name','card_number','mmyy','cvv','auto_charge'];

    protected $casts=[
        'auto_charge'=>'boolean'
    ];

}
