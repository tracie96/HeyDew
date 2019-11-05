<?php

namespace App\Http\Controllers\Modules\FAQ;

use App\FAQ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    //
    /**
     * @OA\POST(
     *     path="/api/faq",
     *     tags={"faq"},
     *     summary="adds a new FAQ",
     *     operationId="addFAQ",
     *     @OA\RequestBody(
     *         description="FAQ Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FAQ")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addFAQ(Request $request){

        //if category does not exist

        $faq=new FAQ([
            'question'=>$request->question,'answer'=>$request->answer,'active'=>true,'category_id'=>$request->category_id
        ]);
        if(!$faq->save()){
            return response()->json(['status'=>400,'message'=>'Failed to add FAQ','data'=>null]);
        }
        return response()->json(['status'=>200,'message'=>'FAQ added successfully','data'=>$faq]);
    }

    public function deactivateFAQ(Request $request){

    }

    public function deleteFAQ(Request $request){

    }

    /**
     * @OA\PATCH(
     *     path="/api/faq/{id}",
     *     tags={"faq"},
     *     summary="update a new FAQ",
     *     operationId="updateFAQ",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Faq Id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="FAQ Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FAQ")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateFAQ(Request $request){
        $updates=[];
        if(isset($request->question) && !empty($request->question)){
          $updates['question']=$request->question;
        }

        if(isset($request->answer) && !empty($request->answer)){
            $updates['answer']=$request->answer;
        }

        if(isset($request->status) && !empty($request->status)){
            $updates['status']=$request->status;
        }

        $faq=FAQ::where(['id'=>$request->id])->first();

        if(!$faq){
            return response()->json(['status'=>404,'message'=>'FAQ does not exist','data'=>null]);
        }

        if(!$faq->update($updates)){
            return response()->json(['status'=>400,'message'=>'Failed to update FAQ','data'=>null]);
        }

        return response()->json(['status'=>200,'message'=>'FAQ updated successfully','data'=>$faq]);
    }

    /**
     * @OA\GET(
     *     path="/api/faq",
     *     tags={"faq"},
     *     summary="fetch all FAQ",
     *     operationId="getFAQs",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getFAQs(Request $request){
        $faqs=FAQ::all();
        return response()->json(['status'=>200,'message'=>'FAQ fetched successfully','data'=>$faqs]);
    }

}
