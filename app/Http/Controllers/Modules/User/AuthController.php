<?php

namespace App\Http\Controllers\Modules\User;

use App\Email;
use App\EmailReset;
use App\EmailVerifier;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Modules\Photographer\PhotographerController;
use App\Jobs\ForgotPasswordJob;
use App\Jobs\UserJoinedJob;
use App\OTP;
use App\User;
use App\UtilityModels\Photographer\PhotographerManager;
use App\UtilityModels\User\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    private $userManager;
    private $photographerManager;

    public function __construct(UserManager $userManager,PhotographerManager $photographerManager)
    {
        $this->userManager=$userManager;
        $this->photographerManager=$photographerManager;
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"auth"},
     *     summary="Logs a user in",
     *     operationId="loginUser",
     *     @OA\RequestBody(
     *         description="User Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
    public function loginUser(Request $request){

        try{
            $object=$this->userManager->login($request);
            return response()->json(['status'=>200,'message'=>'Login Successful','data'=>$object]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }



    /**
     * @OA\Post(
     *     path="/api/auth/create",
     *     tags={"auth"},
     *     summary="Creates a User",
     *     operationId="createAccount",
     *     @OA\RequestBody(
     *         description="User Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function createAccount(Request $request){

        try{
            $object=$this->userManager->createUser($request);
            return response()->json(['status'=>200,'message'=>'Account Created Successfully','data'=>$object]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\Patch(
     *     path="/api/auth/verify/{email}/{pin}",
     *     tags={"auth"},
     *     summary="Verifies a User's account",
     *     operationId="verifyAccount",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="The email for the verification sent to the user",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="pin",
     *         in="path",
     *         description="The verification code sent to the user",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     )
     * )
     */
    public function verifyAccount(Request $request){

        $email_verifier=OTP::where(['email'=>$request->email,'code'=>$request->pin])->first();
        Log::info(json_encode($email_verifier));

        if(!$email_verifier){
            return response()->json(['status'=>400,'message'=>'Verification does not exist','data'=>null]);
        }

        $user=User::where(['email'=>$email_verifier->email])->with("photographer")->first();

        if($user->email_verified){
            return response()->json(['status'=>200,'message'=>'Already Verified','data'=>null]);
        }

        if(!$user->update(['email_verified'=>!$user->email_verified])){
            return response()->json(['status'=>400,'message'=>'Failed to verify account','data'=> null]);
        }

        //delete verification details

        return response()->json(['status'=>200,'message'=>'Verification Successful','data'=>$user]);
    }

    /**
     * @OA\GET(
     *     path="/api/auth/forgotPassword/{url_path}/{email}",
     *     tags={"auth"},
     *     summary="Send a password reset Link",
     *     operationId="forgotPassword",
     *     @OA\Parameter(
     *         name="url_path",
     *         in="path",
     *         description="The Url to the page that would conclude the reset. The final url would be {url_path}/token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="Email of the user requesting for email reset",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function forgotPassword(Request $request){
        $email=$request->email;
        if(!$email){
            return response()->json(['status' => 404, 'message' => 'Email not set', 'data' => null]);
        }

        $user=User::where('email',$email)->first();
        if(!$user){
            return response()->json(['status' => 404, 'message' => 'Email does not exist in our records', 'data' => null]);
        }

        $reset=new EmailReset([
            'hash'=>Hash::make($user->email),
            'email'=>$request->email,
            'url_path'=>$request->url_path
        ]);

        if(!$reset->save()){
            return response()->json(['status' => 404, 'message' => 'Failed to save password reset', 'data' => null]);
        }

        ForgotPasswordJob::dispatch($reset);

        return response()->json(['status' => 200, 'message' => 'Password Reset Email Sent', 'data' => null]);

    }

    /**
     * @OA\POST(
     *     path="/api/auth/resetpassword",
     *     tags={"auth"},
     *     summary="",
     *     operationId="resetPassword",
     *     @OA\RequestBody(
     *         description="User Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ResetForgotPassword")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function resetPassword(Request $request){
        if(empty($request->new_password)){
            return response()->json(['status' => 404, 'message' => 'New password has no value', 'data' => null]);
        }

        if($request->new_password != $request->repeat_new_password){
            return response()->json(['status' => 400, 'message' => 'Repeat password does not match', 'data' => null]);
        }
        $email=EmailReset::where(['hash'=>$request->resetToken])->first();

        if(!$email){
            return response()->json(['status' => 404, 'message' => 'Key not found', 'data' => $email]);
        }

        $user=User::where(['email'=>$email->email])->first();
        if(!$user){
            return response()->json(['status' => 404, 'message' => 'Email not found', 'data' => null]);
        }

        if(!$user->update(['password'=>Hash::make($request->new_password)])){
            return response()->json(['status'=>200,'message'=>'Failed to update password','data'=>null]);
        }

        if(!$email->delete()){
            Log::info('Failed to delete Reset Keys');
        }

        return response()->json(['status' => 200, 'message' => 'Password updated', 'data' => null]);

    }

    /**
     * @OA\Post(
     *     path="/api/auth/photographer/create",
     *     tags={"auth"},
     *     summary="Creates a Photographer User account",
     *     operationId="createQuickAccountForPhotographer",
     *     @OA\RequestBody(
     *         description="User Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function createQuickAccountForPhotographer(Request $request){
        $data=$this->createAccount($request);
        $user=User::where('email',$request->email)->first();

        if(!$user){
            return $data;
        }

        $token=\auth()->attempt([
            'email'=>$request->email,'password'=>$request->password
        ]);
        $user['auth']=$token;
        //\auth()->login()
        try{
            $photographer= $this->photographerManager->addUserToPhotographer($user,$request->about_us,$category=$request->category,$photography_type=$request->photography_type,$region=$request->region,$business_name=$request->business_name);
            $user['photographer']=$photographer;
            return response()->json(['status'=>200,'message'=>'Photographer successfully added','data'=>$user]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }
    }

}

//Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9wZWV4b292MS50ZXN0XC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNTU5MzMyNDA4LCJleHAiOjE1NTkzMzYwMDgsIm5iZiI6MTU1OTMzMjQwOCwianRpIjoiSFRvYUdSUVVERkVybkFjWSIsInN1YiI6MTEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.ENeZNK8rtTtcSowCoaFuDzRNXNPbCKiosSBP8RUAym4