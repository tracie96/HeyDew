<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    //

    protected $fillable=['title','description','amount','metric','status','archived']; //metric = 'sec per mins', e.t.c

    public static function addPricingList($title,$description,$amount,$metric='per day'){
        $pricing=new Pricing([
            'title'=>$title,
            'description'=>$description,
            'amount'=>$amount,
            'metric'=>$metric,
            'status'=>'',
            'archived'=>false
        ]);
        return $pricing->save();
    }

    public static function updatePricing($pricing_id,$title,$description,$amount,$metric='per day'){
        return Pricing::where('id',$pricing_id)->update([
            'title'=>$title,
            'description'=>$description,
            'amount'=>$amount,
            'metric'=>$metric
        ]);
    }

    public static function disablePricing($pricing_id){
        return Pricing::where('id',$pricing_id)->update([
            'archived'=>true
        ]);
    }

    public static function getPricingList(){
        return Pricing::where('archived',false)->get();
    }


}
