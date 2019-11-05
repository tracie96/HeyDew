<?php

namespace App\Http\Controllers\Modules\Payment;

use App\Http\Controllers\Controller;
use App\Payment;
use App\User;
use App\UserPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    /**
     * @OA\GET(
     *     path="/api/payment/test",
     *     tags={"payment"},
     *     summary="Tests the Payment Query",
     *     operationId="testPayment",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     * )
     */
    public function testPayment(Request $request){
        $payment=new Payment();
        return $payment->chargeUser('joseph.nwanna@enov8solutions.com',30000);
    }

    /**
     * @OA\GET(
     *     path="/api/payment/verify/{reference}",
     *     tags={"payment"},
     *     summary="Tests reference verification",
     *     operationId="testVerify",
     *     @OA\Parameter(
     *         name="reference",
     *         in="path",
     *         description="Transaction reference to verify",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     * )
     */
    public function testVerify(Request $request){
        $payment=new Payment();
        return $payment->verifyPayment($request->reference);
    }

    /**
     * @OA\POST(
     *     path="/api/payment",
     *     tags={"payment"},
     *     summary="Creates a new Payment for a user",
     *     operationId="addUserPayment",
     *     @OA\RequestBody(
     *         description="UserPayment Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserPayment")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function addUserPayment(Request $request){
        $user_payment_data=$request->all();
        try{
            $user=\auth()->user();
            $user_payment_data['user_id']=$user->id;
            $user_payment=new UserPayment($user_payment_data);
            if(!$user_payment->save()){
                return response()->json(['status'=>400,'message'=>'Failed to add user payment','data'=>null]);
            }
            return response()->json(['status'=>200,'message'=>'User Payment added','data'=>$user_payment]);
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>'Error adding User Payment','data'=>$e]);
        }

    }


    //pay Userpayment (user_payment_id, amount you want to pay)


}
