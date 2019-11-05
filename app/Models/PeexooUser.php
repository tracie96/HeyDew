<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeexooUser extends Model
{
    //

    public static function addPeexooUser($email,$password,$name,$profile_image){
        $user=new User([
            'name'=>$name, 'email'=>$email, 'password'=>$password,'profile_image'=>$profile_image
        ]);
        return $user->save();
    }



    public static function login($email,$password){

    }

    public static function signUp($email,$password,$profile_image){

    }

    public static function banUser($user_id){

    }

}
