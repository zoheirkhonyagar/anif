<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Resources\v1\Product as ResourceProduct;
use App\Polls;
use App\Product;
use App\ProductCategory;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;

class ProductCategoryController extends apiController
{


    /*protected function setIconAndImage($data)
    {
        foreach ($data['stores'] as $item)
        {
            $item['icon'] = 'http://greenleafveg.com/wp-content/uploads/greenleaf-logo.png';
            $item['image'] = 'https://www.foodnewsfeed.com/sites/foodnewsfeed.com/files/feature-images/fifty-future.jpg';
        }
        return $data;
    }


    public function getBestStores()
    {
        $perPage = Input::get('per_page') ?: 9 ;
        $page = Input::get('page') ?: 1;
        $storeC = new \App\Http\Controllers\StoreController();
        $storesOffer = $storeC->getBestStores($perPage, $page);

        return $this->respondTrue($storesOffer);
    }*/


//    public function show(Request $request)
//    {
//        $store = Store::find($request->id)->product();
//
//        if($store)
//            return $this->respondTrue($store);
//
//        return $this->respondInternalError();
//
//
//    }

    public function showAllProduct(Request $request)
    {
        $product = ProductCategory::find($request->id)->product()->get();

        if($product) {
            $tmpP = [];
            foreach ($product as $item)
            {
                $item = new ResourceProduct($item);
                $tmpP[] = $item ;
            }
            return $this->respondTrue($tmpP);

        }

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


