<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\Store as ResourceStore;
use Illuminate\Http\Request;
use App\Store;

use Illuminate\Support\Facades\Input;


class StoreController extends apiController
{

    public function getOfferStores()
    {
        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        $storesOffer = $storeC->getOfferStores($perPage, $page);

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



//
//    public function show($id)
//    {
//        $poll = Polls::find($id);
//
//        if( !$poll )
//        {
//            return $this->respondNotFound('Poll does not exist');
//        }
//
//        return $this->respond([
//            'ok' => true,
//            'result'=> [$poll],
//            'status' => 200
//        ]);
//
//    }
//
//    public function store(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//           'title' => 'required|min:5'
//        ]);
//
//
//        if( $validator->fails())
//        {
//            $this->statusCode = 422 ;
//            return $this->respondWithError('UNPROCESSABLE ENTITY', $validator->errors()->all());
//        }
//        else
//        {
//            Polls::create($request->all());
//            return $this->RespondCreated('poll successfully created!');
//        }
//    }
//
//    public function destroy($id)
//    {
//        $poll = Polls::find($id);
//
//        if(! $poll)
//        {
//            return $this->respondNotFound('Poll does not exist');
//        }
//        $poll->delete() ;
//        return $this->RespondDeleted('poll successfully deleted');
//    }





}
