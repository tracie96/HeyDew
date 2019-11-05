<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeexooPhotographyCommunityModel extends Model
{
    //
    protected $fillable=['user_id','first_name','last_name','email','tel_number','how_you_heard','other_comment','is_vetted'];
}
