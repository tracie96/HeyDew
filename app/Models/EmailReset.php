<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailReset extends Model
{
    //
    protected $fillable=['url_path','hash','email'];

}
