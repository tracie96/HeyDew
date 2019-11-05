<?php


namespace App\UtilityModels\Photographer;


use App\PhotographerPackage;
use App\PhotographerPackageItem;
use Carbon\Carbon;

class PhotographerPricingPackageManager
{

    public function addPricingPackage(int $photographerId,string $title,int $bookingTypeId,float $bookingPrice,array $items){

        $package=$this->getPhotographerPackageByBookingId($photographerId,$bookingTypeId);

        if($package){
            throw new \Exception("Photographer has package with booking Id",400);
        }

        $photographer_package=new PhotographerPackage([
            'photographerId'=>$photographerId,
            'title'=>$title,
            'bookingTypeId'=>$bookingTypeId,
            'bookingPrice'=>$bookingPrice,
            'is_active'=>true
        ]);

        if(!$photographer_package->save()){
            throw new \Exception('Failed to save Photographer\'s Package',400);
        }

        $this->addItemsToPackage($photographer_package->id,$items);

        return $photographer_package;

    }

    public function addItemsToPackage(int $packageId,array $items){
        $time=Carbon::now()->format("Y:m:d H:i:s");
        foreach ($items as $key=>$value){
            if(!isset($value['title'])){
                throw new \Exception("Title is not set at index ".$key,400);
            }
            if(!isset($value['quantity'])){
                throw new \Exception("Quantity is not set at index ".$key,400);
            }
            if(!isset($value['price'])){
                throw new \Exception("Price is not set at index ".$key,400);
            }
            if (!is_int($value['quantity'])){
                throw new \Exception("Invalid type for quantity at index ".$key,400);
            }
            if (!is_double($value['price'])){
                throw new \Exception("Invalid type for price at index ".$key,400);
            }

            $items[$key]['created_at']=$time;
            $items[$key]['updated_at']=$time;
            $items[$key]['photographer_package_id']=$packageId;
        }

        if(!PhotographerPackageItem::insert($items)){
            throw new \Exception("Failed to insert",400);
        }

        return $items;
    }

    public function getPhotographerPackages(int $photographerId){
        return PhotographerPackage::where(["photographerId"=>$photographerId])->with("packageitems")->first();
    }

    public function getPhotographerPackageByBookingId(int $photographerId,int $bookingTypeId){
        return PhotographerPackage::where(["photographerId"=>$photographerId,"bookingTypeId"=>$bookingTypeId])->with("packageitems")->first();
    }

    public function deletePhotographerPricingPackage(int $photographerId,int $pricingPackageId){
        $package=PhotographerPackage::where(["id"=>$pricingPackageId])->first();
        if(!$package){
            throw new \Exception("Pricing Package with Id does not exist",404);
        }

        if($photographerId != $package->photographerId){
            throw new \Exception("Photographer does not have permission",404);
        }

        if(!$package->delete()){
            throw new \Exception("Failed to delete Photographer Pricing Object",400);
        }

        if(!$this->deleteItemsFromPackage($pricingPackageId)){
            throw new \Exception("Failed to delete Photographer Pricing Items",400);
        }
        return true;
    }

    public function deleteItemsFromPackage(int $pricingPackageId){
        return PhotographerPackageItem::where(['photographer_package_id'=>$pricingPackageId])->delete();
    }

}