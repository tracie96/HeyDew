<?php


namespace App\UtilityModels\Booking;


use App\BookingType;

class BookingTypeManager
{

    public function getBookingTypes(){
        return BookingType::all()->get();
    }
}