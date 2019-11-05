<?php

namespace App;

use App\Jobs\EmaizxlJob;
use App\Mail\SampleEmail;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //

    const Email_TYPE_WELCOME='';
    const Email_TYPE_RESET_PASSWORD_LINK='';
    const Email_TYPE_VERIFY_ACCOUNT='';
    const Email_TYPE_APP_UPDATE='';

    public static function sendSampleEmail(){
        $user=new User();
        EmailJob::dispatch($user,new SampleEmail());
    }

    public static function sendResetPasswordEmail($user,$reset){
        //EmailJob::dispatch();
    }

    public static function getEmailLogs(){

    }


}
