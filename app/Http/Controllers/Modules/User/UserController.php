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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('jwt.auth:api', ['except' => ['loginUser','createAccount','forgotPassword','resetPassword']]);
    }


    /**
     * @OA\GET(
     *     path="/api/user",
     *     tags={"user"},
     *     summary="Get Authenticated User's data",
     *     operationId="getUser",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getUserByToken(Request $request){
        try {
            $user = \auth()->user();

            if($user->archived){
                return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
            }
            $user=User::where(['id'=>$user->id])
                ->with('userpayments.installments')
                ->with('userphotographerbookings.photographer')
                ->first();
            return response()->json(['status' => 200, 'message' => 'User Fetched Successsfully', 'data' => $user]);
        }catch (\Exception $e){
            return response()->json(['status' => 400, 'message' => 'Error getting User', 'data' => null,'error'=>$e->getMessage()]);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/user/archive/{id}",
     *     tags={"user"},
     *     summary="Deactivate a User",
     *     operationId="archiveUser",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the User to ban",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function archiveUser(Request $request){
        try {
            $user_id=$request->id;
            $user = User::where('id',$user_id)->first();
            if(!$user){
                return response()->json(['status' => 404, 'message' => 'User with Id does not exist', 'data' => null]);
            }

            if($user->archived){
                return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
            }

            if(!$user->update(['archived'=>true])){
                return response()->json(['status' => 400, 'message' => 'Failed to ban User', 'data' => null]);
            }
            return response()->json(['status' => 200, 'message' => 'User banned Successsfully', 'data' => $user]);
        }catch (\Exception $e){
            return response()->json(['status' => 400, 'message' => 'Error archiving User', 'data' => null,'error'=>$e->getMessage()]);
        }
    }

    /**
     * @OA\PATCH(
     *     path="/api/user/update",
     *     tags={"user"},
     *     summary="Updates an Authenticated User. It can only update the name and profile image ",
     *     operationId="updateUser",
     *     @OA\RequestBody(
     *         description="User Oject",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function updateUser(Request $request){
        try {
            $user=\auth()->user();
            $user_id=$user->id;
            if(!$user){
                return response()->json(['status' => 404, 'message' => 'User does not exist', 'data' => null]);
            }

            if($user->archived){
                return response()->json(['status'=>400,'message'=>'User has been deactivated','data'=>null]);
            }

            $updatable=[];
            if(isset($request->last_name)){
                $user->last_name=$request->last_name;
                $updatable['last_name']=$request->last_name;
            }

            if(isset($request->first_name)){
                $user->first_name=$request->first_name;
                $updatable['first_name']=$request->first_name;
            }

            if(isset($request->profile_image)){
                $user->profile_image=$request->profile_image;
                $updatable['profile_image']=$request->profile_image;
            }

            if(!$user->update($updatable)){
                return response()->json(['status' => 400, 'message' => 'Failed to ban User', 'data' => null]);
            }
            $user=User::where(['id'=>$user_id])->with("photographer")->first();
            return response()->json(['status' => 200, 'message' => 'User updated Successsfully', 'data' => $user]);
        }catch (\Exception $e){
            return response()->json(['status' => 400, 'message' => 'Error archiving User', 'data' => null,'error'=>$e->getMessage()]);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/user/id/{id}",
     *     tags={"user"},
     *     summary="Get a User's data by user Id. Prameter",
     *     operationId="getUserById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the User to ban",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function getUserById(Request $request){
        try {
            $user = User::where('id',$request->id)->first();
            if(!$user){
                return response()->json(['status' => 404, 'message' => 'User does not exist', 'data' => null]);
            }
            return response()->json(['status' => 200, 'message' => 'User Fetched Successfully', 'data' => $user]);
        }catch (\Exception $e){
            return response()->json(['status' => 400, 'message' => 'Error getting User', 'data' => null,'error'=>$e->getMessage()]);
        }
    }

}

//Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9wZWV4b292MS50ZXN0XC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNTU5MzMyNDA4LCJleHAiOjE1NTkzMzYwMDgsIm5iZiI6MTU1OTMzMjQwOCwianRpIjoiSFRvYUdSUVVERkVybkFjWSIsInN1YiI6MTEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.ENeZNK8rtTtcSowCoaFuDzRNXNPbCKiosSBP8RUAym4