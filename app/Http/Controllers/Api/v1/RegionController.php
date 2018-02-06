<?php

namespace App\Http\Controllers\Api\v1;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends apiController
{
    public function getAll(Request $request)
    {
        $validData = $this->validate($request, [
            'city_id' => 'required|exists:cities,id',
        ]);

        $regionM = Region::where('city_id' ,$validData['city_id'])->get();

        return $this->respondTrue($regionM);
    }
}
