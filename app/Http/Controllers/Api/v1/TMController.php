<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\Http\Resources\v1\Regent as RegentResource;
use App\ReferredUser;
use App\Regent;
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

        $userM = auth()->user();
        $TMCodeM = TMCode::where('code', $validData['code']);
        $regenM = Regent::where('code', $validData['code']) ;
        //چک کردن برای معتبر بودن کد
        if($TMCodeM->count())
        {
            $TMCodeM = $TMCodeM->first();

            //کد هنوز فعال و قابل اسفاده باشه
            if($TMCodeM->is_active == 1)
            {
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

        else if($regenM->count())
        {
            $referredUserM = ReferredUser::where('user_id', $userM->id) ;
            $regentUserM = Regent::where('user_id', $userM->id)->first(); //کاربری که کد رو زده بفهمیم تا حالا کسی رو معرفی کرده یا نه

            $regenM = $regenM->first();
            if($regenM->user_id == $userM->id)
            {
                $messageToUser = "کد خود تون رو نمی تونید به عنوان معرف وارد کنید." ;
                return $this->respondSuccessMessage('Unauthorized request.', $messageToUser);
            }

            if(! $referredUserM->count())
            {
                $TMPoint = 5000 ;
                $messageToUser = " حساب شما در آنیف به مقدار $TMPoint TM شارژ شد و بعد از اولین خرید شما امتیاز معرفی برای دوست تون ارسال میشه.";
                if($regentUserM->count_introduced > 0)
                {
                    $TMPoint = 1000;
                    $messageToUser = "آنیفی عزیز شما که مشتری خوب ما هستی و نیاز به کد معرف نداری ولی بازم $TMPoint TM حسابت رو شارژ کردیم :)";
                }
                ReferredUser::create([
                   'regent_id' => $regenM->id,
                   'user_id' => $userM->id,
                   'TM' => $TMPoint,
                ]);

                $this->insertTMTransaction($userM, $TMPoint, $userM->TM, 1, 3, $regenM->user_id);
                //افزایش تعداد اعضای معرفی کرده
                $regenM->count_introduced++ ;
                $regenM->save() ;
                return $this->RespondCreated($messageToUser);

            }

            return $this->respondSuccessMessage('The code has been used.', 'خطا!!  شما قبلا از روش معرفی، شارژ خود رو یک بار افزایش داده اید.');

        }

        return $this->respondSuccessMessage('not found charge code', 'کد شارژ تی ام صحیح نمی باشد.');
    }

    public function insertTMTransaction($userM,$amount ,$inventory, $type = 1,$methodId = 1, $managerId = null)
    {
        $factor = 1 ;
        if($type != 1)
            $factor = -1 ;
        if($methodId != 2)
        {
            $userM->TM = $userM->TM +($factor * $amount) ;
            $userM->all_TM = $userM->all_TM +($factor * $amount) ;

            $userM->save() ;
        }
        return TMTransaction::create(
            [
                'user_id' => $userM->id,
                'type' => $type,
                'amount' => $amount,
                'inventory' => $inventory,
                'method_id' => $methodId,
                'manager_id' => $managerId,
            ]
        );
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

    public function getRegentCode()
    {

        $userM = auth()->user();
        $regentM = $userM->regent()->first();

        if(! $regentM)
        {

            $userM->regent()->create([
               'code' => 'Anif'.$userM->anif_code,
            ]);

            $regentM = $userM->regent()->first();
        }

        $regentM = new RegentResource($regentM);

        return $this->respondTrue($regentM) ;

    }



}
