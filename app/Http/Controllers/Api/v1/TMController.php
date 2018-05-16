<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\Http\Resources\v1\Regent as RegentResource;
use App\ReferredUser;
use App\Regent;
use App\TMCode;
use App\TMTransaction;
use App\UserTMCode;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Kavenegar\KavenegarApi;
use Morilog\Jalali\jDateTime;


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
            if($type != 1) // عملیات برداشت
                $userM->all_TM = $userM->all_TM +($amount) ;

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

    public function decreaseTMWAdmin(Request $request)
    {
        $validData = $this->validate($request, [
                'anif_code' => 'required|exists:users,anif_code',
                'TM' => 'required|alpha_num'
            ]
        );

        if(auth()->user()->type < 1)
        {
            return $this->respondSuccessMessage('Unauthorized access level.', 'سطح دسترسی غیر مجاز');
        }

        $userCustomer = User::where('anif_code', $validData['anif_code'])->first();
        if($userCustomer)
        {

            if($userCustomer->TM >= $validData['TM'])
            {
                $adminID = auth()->user()->id ;
                $this->insertTMTransaction($userCustomer, $validData['TM'], $userCustomer->TM,2, 4, $adminID);
                $this->insertTMTransaction(auth()->user(), $validData['TM'], auth()->user()->TM,1, 5, $adminID);

                $adminName = auth()->user()->first_name . " " . auth()->user()->last_name;

                $this->sendSMSTranTM($validData['TM'], $userCustomer->TM, $userCustomer->phone_number, 2, $adminName);
                $this->sendSMSTranTM($validData['TM'], auth()->user()->TM, auth()->user()->phone_number, 1, 'آنیف');
                return $this->respondWithMessage('Request Success.',"اعتبار تی ام کسر و در حساب آنیف شما وارد شد.");
            }

            $message = 'عدم موجودی کافی تی ام برای ثبت این تراکنش';
            return $this->respondWithMessage('TM is not enough.', $message);

        }
        $this->respondSuccessMessage('Not founded user', 'کاربری با این مشخصات یافت نشد') ;
    }

    /**
     * @param $validData
     * @param $userCustomer
     */
    public function sendSMSTranTM($tran_TM,$inventory, $receptor, $type = 2, $by)
    {
        try {
            $api = new KavenegarApi("6D4C4566376F6C69644B37355A566849477A702B73513D3D");
            $sender = "10004346";
//            $receptor = array(auth()->user()->phone_number);
            $typeTrn = "برداشت:";
            if($type == 1)
                $typeTrn = "واریز:";
            $jDate = jDatetime::strftime('Y/m/d H:i', strtotime(date('Y-m-d H:i:s')));
            $message = "‏*آنیف سامانه باشگاه مشتریان *"
                . " \n $typeTrn " . $tran_TM . " TM" . "\nتوسط: " . $by . "\n مانده: "
                . $inventory . " TM\n $jDate";
            $result = $api->Send($sender, $receptor, $message);

            return  $result[0]->status;
//            if ($result) {
//                foreach ($result as $r) {
//                    echo "messageid = $r->messageid";
//                    echo "message = $r->message";
//                    echo "status = $r->status";
//                    echo "statustext = $r->statustext";
//                    echo "sender = $r->sender";
//                    echo "receptor = $r->receptor";
//                    echo "date = $r->date";
//                    echo "cost = $r->cost";
//                }
//            }
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e->errorMessage();
        }
    }

}
