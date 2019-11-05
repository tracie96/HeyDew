<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name','first_name', 'email','tel_number', 'password', 'profile_image','job_description','archived','email_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'archived' => 'boolean',
        'email_verified' => 'boolean'
    ];



    public static function addUser($email,$phone_number,$password,$name,$profile_image){
        $user=new User([
            'name'=>$name,
            'email'=>$email,
            'tel_number'=>$phone_number,
            'password'=>$password,
            'profile_image'=>$profile_image,
            'archived'=>false
        ]);
        return $user->save();
    }

    public static function login($email,$password){

    }

    public static function signUp($email,$password,$profile_image){

    }

    public static function banUser($user_id){
        return User::where('id',$user_id)->update(['archived'=>true]);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userpayments(){
        //lists all payments attached to this user
        return $this->hasMany('App\UserPayment','user_id','id');
//        UserPayment::all()
    }

    public function userphotographerbookings(){
        //lists all payments attached to this user
        return $this->hasMany('App\Bookings','user_id','id');
    }

    public function albums(){

    }

    public function photographer(){
        return $this->belongsTo("App\Photographer","id","user_id");
    }

}
