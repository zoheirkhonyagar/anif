<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\Http\Requests\ApiUserAndStoreUnique;
use App\Http\Resources\v1\Customer as CustomerResource;
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
//        $storeM['member_count'] = $storeM['member_count'] +1 ; //تعداد اعضای مجموعه را افزایش می دهم
//        $storeM->save();
//        dd($storeM) ;die;
        $storeM = Store::find($request['store_id']);
        $storeM->increment('member_count');

        //اطلاعات این کاربر در مشتری های رستوران ذخیره می کنم
        $customers = auth()->user()->Customer()->create($validData);
        $customers['TM'] = $storeM['crm_TM'] ;
        $customers->save();

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


        if($customerM->count() == 0)
            return $this->respondBadRequest('Bad Request: This user is not registered to the customer club.','شما در باشگاه مشتریان مجموعه عضو نمی باشید.');
        return $this->respondTrue($customerM->get());
    }

    public function getAllUserTM(Request $request)
    {


        $userId = auth()->user()->id;
        $customerM = DB::table('customers')->where('user_id', $userId);


        if($customerM->count() == 0)
            return $this->respondSuccessMessage('This user is not registered to the customer club.','این کاربر در هیچ مجموعه ای عضو نمی باشد');
        $customerArrayM = [];
        $customerM = $customerM->get();
        foreach ($customerM as $item)
            $customerArrayM[] = new CustomerResource($item);
        return $this->respondTrue($customerArrayM);
    }

    public function exitCustomer(Request $request)
    {
        $validData = $this->validate($request, [
                'store_id' => 'required',
            ]
        );
        $userId = auth()->user()->id;
        $customerM = Customer::where('store_id', $validData['store_id'])
            ->where('user_id', $userId);

        $tmp = $customerM->first();
        if($customerM->count() == 0 || $tmp->is_active == 0)
            return $this->respondBadRequest('Bad Request: This user is not registered to the customer club.','شما در باشگاه مشتریان مجموعه عضو نمی باشید.');
        if($tmp->all_TM != 0 || $tmp->TM != 0)
            return $this->respondBadRequest('Bad Request: Not Allowed', 'به دلیل داشتن تی ام در این مجموعه این قابلیت در دسترس نیست');
//            $customerM->update(['is_active' => 0]);
        else
            $customerM->delete() ;

        $storeM = Store::find($validData['store_id']);
        $storeM->decrement('member_count');
        return $this->RespondDeleted("شما از باشگاه مشتریان این مجموعه خارج شدید.");
    }

    
}
