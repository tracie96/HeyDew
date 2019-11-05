<?php


namespace App\UtilityModels\User;


use App\BillingAddress;
use App\Jobs\UserJoinedJob;
use App\User;
use App\UserNotificationSettings;
use App\UtilityModels\Photographer\PhotographerManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManager
{


    public function __construct()
    {

    }

    public function login(Request $request){
        $email=$request->email;
        $password=$request->password;
        if(!isset($email) || empty($email)){
            throw new \Exception('Email is empty',400);
        }

        if(!isset($password) || empty($password)){
            throw new \Exception('Password is empty',400);
        }

        $user=User::where('email',$email)->with("photographer.cinetype")->first();

        
        if($user->photographer){
            $user->photographer->cinetype[]="PHOTOS";
        }

        if(!$user){
            throw new \Exception('Account with Email does not exist',404);
        }

        if(!$this->accountActive($user)){
            throw new \Exception('Account is not active',400);
        }

        $token=$this->generateUserAuth($email,$password);

        $user['auth']=$token;

        return $user;
    }

    public function createUser(Request $request){

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('No valid email found',400);
        }
        //filter tel number

        $user_exists=User::where('email',$request->email)->first();

        if($user_exists){
            throw new \Exception('Email exists',400);
        }

        $user=new User([
            'last_name'=>$request->last_name,
            'first_name'=>$request->first_name,
            'email'=>$request->email,
            'tel_number'=>$request->tel_number,
            'password'=>Hash::make($request->password),
            'profile_image'=>$request->profile_image,
            'archived'=>false,
            'email_verified'=>false
        ]);


        if(!$user->save()){
            throw new \Exception('Failed to save User data',400);
        }

        try {
            UserJoinedJob::dispatch($user);
        }catch (\Exception $e0){
            throw new \Exception($e0->getMessage(),400);
        }

        return $this->login($request);
    }

    public function accountActive(User $user){
      //  throw new \Exception('Account has not been verified',300);
        if($user->archived){
            throw new \Exception('Account is deactivated',400);
        }
        if(!$user->email_verified){
         //   throw new \Exception('Account has not been verified',400);
        }
        return true;
    }

    public function generateUserAuth(string $email,string $password ){
        try {
            $token = \auth()->attempt([
                'email' => $email, 'password' => $password
            ],true);
            if (!$token) {
                throw new \Exception('Invalid credentials', 400);
            }
            return $token;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage(),404);
        }
    }

    public function updatePhoneNumber(User $user){
        $this->accountActive($user);

    }


    public function sendPhoneUpdateOTP(){

    }

    public function updateEmailAddress(){
        //send a link with the email update link
    }

    public function updatePassword(){

    }

    public function deactivateAccount(){

    }

    public function updateNotification(User $user,UserNotificationSettings $notification){
        $this->accountActive($user);
        //get user notification settings
        //update
        //return
    }

    public function getUserById(int $user_id){
        return User::where(['id'=>$user_id])->first();
    }

    public function addBillingAddress(BillingAddress $address){

    }

    public function getBillingAddresses(int $user_id){

    }

}