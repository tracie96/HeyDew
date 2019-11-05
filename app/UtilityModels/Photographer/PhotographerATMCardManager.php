<?php


namespace App\UtilityModels\Photographer;


use App\PhotographerCardDetails;

class PhotographerATMCardManager
{


    public function saveCardDetails(int $photographer_id,string $first_name,string $last_name,string $card_number,string $mmyy,string $cvv,boolean $auto_charge){

        $new_card=new PhotographerCardDetails([]);
        if(!$new_card->save()){
            throw new \Exception('Failed to save card details',400);
        }
        return $new_card;
    }

    public function addCardDetails(int $photographer_id,array $cardDetails):PhotographerCardDetails{
        $cardDetails=new PhotographerCardDetails($cardDetails);
        if(!$cardDetails->save()){
            throw new \Exception('Failed to save card details',400);
        }

        return $cardDetails;
    }

    public function getPhotographerATMCards(int $photographer_id){
        $cards=PhotographerCardDetails::where(['photographer_id'=>$photographer_id])->get();
        return $cards;
    }
}