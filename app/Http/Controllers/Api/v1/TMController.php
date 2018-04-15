<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\TMCode;
use App\TMTransaction;
use App\UserTMCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TMController extends apiController
{
    public function charging(Request $request)
    {

        $validData = $this->validate($request, [
                'code' => 'required'
            ]
        );


        $TMCodeM = TMCode::where('code', $validData['code']);

        //چک کردن برای معتبر بودن کد
        if($TMCodeM->count())
        {
            $TMCodeM = $TMCodeM->first();

            //کد هنوز فعال و قابل اسفاده باشه
            if($TMCodeM->is_active == 1)
            {
                $userM = auth()->user();
                $userId = $userM->id;

                $userTMCodeM = UserTMCode::where('code_id', $TMCodeM->id)
                                    ->where('user_id', $userId);
                //چک برای اینکه کاربر از این کد قبلا استفاده نکرده باشه
                if($userTMCodeM->count())
                    return $this->respondSuccessMessage('The code has already been used.', 'دوست عزیز این کد قبلا توسط شما استفاده شده است.');

                //کد مربوط به شارژ حساب آنیف هست یا نه
                if($TMCodeM->store_id == null)
                {
                    $this->disableChargingCode($TMCodeM, $userM, 1);
                    $userM->TM = $userM->TM + $TMCodeM->amount ;
                    $userM->all_TM = $userM->all_TM + $TMCodeM->amount ;

                    $userM->save() ;
                    $txtTM = $TMCodeM->amount." TM ";
                    return $this->RespondCreated("حساب شما در آنیف $txtTM شارژ شد.");

                }
                else
                {
                    $customerM = Customer::where('store_id', $TMCodeM->store_id)
                        ->where('user_id', $userId);
                    if(! $customerM->count())
                    {

                        $customerM = Customer::create(
                            [
                                'store_id' => $TMCodeM->store_id,
                                'user_id' => $userM->id,
                            ]
                        );

                        $customerM->TM = 0 ;

                    }
                    else
                        $customerM = $customerM->first();
                    $this->disableChargingCode($TMCodeM, $userM, 2, $customerM->TM);
                    $customerM->TM = $customerM->TM + $TMCodeM->amount ;
                    $customerM->all_TM = $customerM->all_TM + $TMCodeM->amount ;
                    $txtTM = $TMCodeM->amount." TM ";
//                    dd($customerM[0]);die;
                    $customerM->save() ;
                    return $this->RespondCreated("حساب شما در باشگاه مشتریان مجموعه $txtTM شارژ شد.");


                }

            }

            return $this->respondSuccessMessage('The code has been used.', 'کد شارژ قبلا استفاده شده است.');

        }
        return $this->respondSuccessMessage('not found charge code', 'کد شارژ تی ام صحیح نمی باشد.');
    }


    public function disableChargingCode($TMCodeM, $userM, $methodType = 1, $inventory = 0)
    {
        $TMCodeM->count_usable--;
        if($TMCodeM->count_usable == 0)
            $TMCodeM->is_active = 0 ;

        if($methodType != 2)//برای وضعیتی هست که تراکنش از نوع تی ام در آنیف
        {
            $TMCodeM->store_id = null;
            $inventory = $userM->TM;
        }


        TMTransaction::create(
            [
                'user_id' => $userM->id,
                'type' => 1,
                'amount' => $TMCodeM->amount,
                'inventory' => $inventory,
                'method_id' => $methodType,
                'store_id' => $TMCodeM->store_id,
            ]
        );

        UserTMCode::create(
            [
                'user_id' => $userM->id,
                'code_id' => $TMCodeM->id,
            ]
        );

        $TMCodeM->save() ;
    }


}
