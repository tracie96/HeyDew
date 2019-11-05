<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSettingsType extends Model
{
    //
    protected $fillable=['title','id_key','enabled'];
    protected $casts=[
        'enabled'=>'boolean'
    ];

    public function items(){
        return $this->hasMany('App\NotificationSettingsItem','notification_settings_type_key','id_key');
    }

}
