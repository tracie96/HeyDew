<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    //
    protected $fillable=['question','answer','active','category_id'];
    protected $table='faqs';
}
