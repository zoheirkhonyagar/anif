<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\Http\Requests\ApiUserAndStoreUnique;
use App\Store;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends apiController
{


    public function storeCustomer(ApiUserAndStoreUnique $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required|unique:customers,store_id,NULL,id,user_id,'.auth()->user()->id,

            ]
        );

        $storeM = Store::find($request['store_id']);
//        $storeM['member_count'] = $storeM['member_count'] +1 ; //تعداد اعضای مجموعه را افزایش می دهم
//        $storeM->save();
//        dd($storeM) ;die;

        $storeM = Store::find($request['store_id']);
        $storeM->increment('member_count');

        //اطلاعات این کاربر در مشتری های رستوران ذخیره می کنم
        auth()->user()->Customer()->create($validData);

        return $this->RespondCreated('شما به باشگاه مشتریان این مجموعه پیوستید.');
    }

    public function getCustomer(Request $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required',
            ]
        );

        $userId = auth()->user()->id;
        $customerM = DB::table('customers')->where('store_id', $validData['store_id'])
                                        ->where('user_id', $userId);

//        $customerM = auth()->user()->Customer()->get();

        if($customerM->count() == 0)
            return $this->respondBadRequest('Bad Request: This user is not registered to the customer club.','شما در باشگاه مشتریان مجموعه عضو نمی باشید.');
        return $this->respondTrue($customerM->get());
    }

    
}
