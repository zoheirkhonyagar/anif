<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends apiController
{

    public function getAllCities()
    {

        $cities = City::all();


        return $this->respondTrue($cities);
    }
}
