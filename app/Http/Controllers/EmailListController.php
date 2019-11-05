<?php

namespace App\Http\Controllers;

use App\EmailList;
use Illuminate\Http\Request;

class EmailListController extends Controller
{
    //
    public function store(){
//        request()->validate([
//            "email" => "required|email",
//            "first_name" => "required",
//            "last_name" => "required"
//        ]);
        try{
           $email =  EmailList::forceCreate(request()->all());
           return response()->json([
              "success" => "Created Successfully",
               "status" => 200
           ]);
        }catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage(),
                "status" => 400
            ]);
        }
    }
}
