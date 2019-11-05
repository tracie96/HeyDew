<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class OTP extends Model
{
    //
    protected $fillable =['code','email','user_id','key_1','key_2'];
    protected $table='otp';
}
