<?php

namespace App\Http\Controllers\Modules\Pricing;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    //

    public static function getPricingLists(Request $request){
        $request=$request->all();
    }


    public static function subscribeUserToPricing(){

        $get_balance_from_existing_subcription=0;

        $deactivate_all_previous_transactio=1;

        $create_new_user_transaction=1;





    }
}
