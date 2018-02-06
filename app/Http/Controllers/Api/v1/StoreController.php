<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\Store as ResourceStore;
use Illuminate\Http\Request;
use App\Store;

use Illuminate\Support\Facades\Input;


class StoreController extends apiController
{

    public function getOfferStores(Request $request)
    {
        $validData = $this->validate($request, [
            'city_id' => 'exists:cities,id',
            'region_id' => 'exists:regions,id',
        ]);
        if(! isset($request['city_id']))
            $validData['city_id'] = 1;
        if(! isset($request['region_id']))
            $validData['region_id'] = 1;
        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        $storesOffer = $storeC->getOfferStores($perPage, $page, false, $validData['city_id'], $validData['region_id']);

        return $this->respondTrue($this->setIconAndImage($storesOffer));
    }

    protected function setIconAndImage($data)
    {
        $tmpS = [];
        foreach ($data['stores'] as $item)
        {
            $tmpS[] = new ResourceStore($item);
        }
        return $tmpS;
    }


    public function getBestStores()
    {
        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        $storesOffer = $storeC->getBestStores($perPage, $page);

        return $this->respondTrue($storesOffer);
    }


    public function show(Request $request)
    {
        $store = Store::find($request->id);

        if($store)
        {
            $store = new ResourceStore($store);
            return $this->respondTrue($store);
        }

        return $this->respondInternalError();
    }

    public function showAllCategory(Request $request)
    {
        $category = Store::find($request->id)->productCategory()->with('product')->get();

//        foreach ($category as $item)
//        {
//            $products = ProductCategory::with('');
//        }
        if($category)
            return $this->respondTrue($category);

        return $this->respondInternalError();
    }
}
