<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSettingsItem extends Model
{
    //
    protected $fillable=['notification_settings_type_key','item_key','title','default'];
    protected $casts=['default'=>'boolean'];
}
