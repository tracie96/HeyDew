<?php

namespace App\Http\Controllers\Modules\Photographer;

use App\Photographer;
use App\UtilityModels\Photographer\PhotographerManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotographerCalendarController extends Controller
{
    private $photographerManager;

    public function __construct(PhotographerManager $photographerManager)
    {
        $this->photographerManager=$photographerManager;
    }

}
