<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Customer;
use App\Http\Resources\v1\Store as ResourceStore;
use Illuminate\Http\Request;
use App\Store;
use App\Http\Resources\v1\User as UserResource;
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
            $request['filter_type'] = 'offer';

        if(! isset($request['api_token']))
        {
            $request['filter_type'] = 'offer';
        }

        if(!isset($request['sort_type']) && !isset($request['sort_by']))
        {
            $request['sort_by'] = 'max_off';
            $request['sort_type'] = 'desc';
        }

        $customerM = null;
        if( isset($request['api_token']))
        {
            $request['filter_type'] = 'offer';
            $user = new UserResource(auth()->user());

//            dd($user['id']);die;
//            $customerM = Custome ::where([
////                            'store_id' => 3,
//                            'user_id' => $user['id'],
//            ]);
            $customerM = DB::table('customers')->whereRaw(
                'user_id = '. $user['id'].' and store_id = 3'
            )->get();

            return $this->respondTrue($customerM);
        }
        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        if($request['filter_type'] == 'offer')
            $storesOffer = $storeC->getOfferStores($perPage, $page, false, $validData['city_id'], $validData['region_id'],$request['sort_by'], $request['sort_type'], $validData['store_category']);
        else if($request['filter_type'] == 'best')
            $storesOffer = $storeC->getOfferStores(5, 1, false, $validData['city_id'], $validData['region_id'], $request['sort_by'], $request['sort_type'], $validData['store_category']);
        else if($request['filter_type'] == 'new')
            $storesOffer = $storeC->getOfferStores(5, 1, false, $validData['city_id'], $validData['region_id'], 'created_at', 'desc', $validData['store_category']);

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
}
