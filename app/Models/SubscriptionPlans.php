<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlans extends Model
{
    //audience_type
    protected $fillable=['title','details','fee','duration','is_recurring'];
    protected $table='subscriptionplans';
}
