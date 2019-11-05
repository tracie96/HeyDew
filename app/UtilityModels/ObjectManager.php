<?php


namespace App\UtilityModels;


class ObjectManager
{
        public function getMatches(array $Input,array $possibleMatches){
            $returnValues=[];
            foreach ($Input as $value){
                foreach ($possibleMatches as $match){
                    if($value === $match){
                        $returnValues[]=$value;
                        break;
                    }
                }
            }
            return $returnValues;
        }
}