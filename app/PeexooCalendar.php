<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeexooCalendar extends Model
{
    //
    protected $fillable=['user_id','start_date','end_date','description','parent_object','parent_object_id'];

}
