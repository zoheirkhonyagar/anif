<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Api\v1\TMController;
use App\Http\Resources\v1\Regent as RegentResource;
use App\ReferredUser;
use App\Regent;
use App\TMCode;
use App\TMPackage;
use App\TMTransaction;
use App\Transaction;
use App\UserTMCode;
use App\User;
use function GuzzleHttp\Promise\is_settled;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Kavenegar\KavenegarApi;
use Morilog\Jalali\jDateTime;
use Zarinpal\Zarinpal;


class TMStoreController extends Controller
{
    public function showTMPackage(Request $request)
    {

        if(! isset($request['user_id']))
        {
            return redirect('login') ;
        }

        $validData = $this->validate($request, [
                'user_id' => 'exists:users,id'
            ]
        );

        $TMPackageM = TMPackage::where('is_active', 1)->get();
        $userM = User::find($validData['user_id']) ;

        return view('main.tm-store-page.index', compact('TMPackageM', 'userM'));

    }

    public function verify(Zarinpal $zarinpal) {

        $tranO = Transaction::find(Input::get('transaction_id')) ;

        $payment = [
            'Authority' => Input::get('Authority'), // $_GET['Authority']
            'Status'    => Input::get('Status'),    // $_GET['Status']
            'Amount'    => $tranO->amount
        ];
        $response = $zarinpal->verify($payment);

        if($response['Status'] === 100) {
            $tranO->status = 100 ;
            $tranO->save() ;
            $userM = $tranO->user()->first() ;
            $tmC =  new TMController() ;

            $tmPackage = TMPackage::find($tranO->fk) ;
            $TM = $tmPackage->TM ;
            if($tmPackage->TM == 0)
                $TM = $tranO->amount / (100 - $tmPackage->off) * $tmPackage->off + $tranO->amount ;

            $tmC->insertTMTransaction($userM, $TM, $userM->TM, 1,$tranO->method_id) ;
            $tmC->sendSMSTranTM($TM, $userM->TM , $userM->phone_number, 1, 'آنیف');
            return 'Payment was successful,
        RefID: '.$response['RefID'].',
        Message: '.$response['Message'];
        }
        if($tranO->status != 100)
            $tranO->status = -1 ;
        $tranO->save() ;
        return 'Error,
        Status: '.$response['Status'].',
        Message: '.$response['Message'];
    }

}
