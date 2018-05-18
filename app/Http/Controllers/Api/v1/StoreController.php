<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\Store as ResourceStore;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class StoreController extends apiController
{

    public function getOfferStores(Request $request)
    {
        return $this->getStores($request);
    }

    public function getStores(Request $request)
    {
        $validData = $this->validate($request, [
            'city_id' => 'exists:cities,id',
            'region_id' => 'exists:regions,id',
            'store_category' => 'exists:store_categories,id',
        ]);
        if(! isset($request['city_id']))
            $validData['city_id'] = 1;
        if(! isset($request['region_id']))
            $validData['region_id'] = 0;
        if(! isset($request['store_category']))
            $validData['store_category'] = 0;

        if(! isset($request['filter_type']))
            $request['filter_type'] = 'no';

        if(!isset($request['sort_type']) && !isset($request['sort_by']))
        {
            $request['sort_by'] = 'sort_weight';
            $request['sort_type'] = 'desc';
        }

        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        $storesOffer = $storeC->getOfferStores($perPage, $page, false, $validData['city_id'], $validData['region_id'],$request['sort_by'], $request['sort_type'], $request['filter_type'],$validData['store_category']);

        return $this->respondTrue( $this->setIconAndImage($storesOffer) );
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

    public function search(Request $request)
    {
        $validData = $this->validate($request, [
                'text' => 'required',
                'city_id' => 'exists:cities,id',
            ]
        );

        if(! isset($request['city_id']))
            $validData['city_id'] = 1;
        $text = $validData['text'];
//        $stores = Store::where(function ($q) use ($text, $validData) {
//            $q->where("city_id", '=', $validData['city_id'] )->Where('name', 'like', "%{$text}%")->orWhere('address', 'like', "%{$text}%")->orWhere('explain', 'like', "%{$text}%");
//        })->paginate(5);

        $stores = Store::whereRaw("is_active = 1 AND city_id = ".$validData['city_id'])
            ->where('name', 'like', "%{$text}%")
            ->orWhere('address', 'like', "%{$text}%")->whereRaw("is_active = 1 AND city_id = ".$validData['city_id'])
            ->orWhere('explain', 'like', "%{$text}%")->whereRaw("is_active = 1 AND city_id = ".$validData['city_id'])
            ->get();



        if($stores->count() != 0)
        {
            $tmpS = [];
            foreach ($stores as $store)
            {
                $tmp = DB::table('products')->select(DB::raw('max(off) as maxOff'))->
                where('store_id', $store['id'])->first();

                if ($tmp->maxOff) {
                    $store['max_off'] = $tmp->maxOff;

                }
                else
                    $store['max_off'] = 0;
                $tmpS[] = new ResourceStore($store);
            }
            return $this->respondTrue($tmpS);
        }

        return $this->respondSuccessMessage("Your search - $text - did not match any documents.", "جستجوی شما ". $text ." هیچ موردی یافت نشد");

    }
}
