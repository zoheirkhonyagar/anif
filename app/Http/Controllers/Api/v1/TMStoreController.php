<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use App\Http\Resources\v1\Regent as RegentResource;
use App\ReferredUser;
use App\Regent;
use App\TMCode;
use App\TMPackage;
use App\TMTransaction;
use App\Transaction;
use App\UserTMCode;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Kavenegar\KavenegarApi;
use Morilog\Jalali\jDateTime;
use Zarinpal\Zarinpal;


class TMStoreController extends apiController
{
    public function showTMPackage(Request $request)
    {
        $validData = $this->validate($request, [
                'user_id' => 'exists:users,id'
            ]
        );

        $TMPackageM = TMPackage::where('is_active', 1)->get() ;

        return $this->respondTrue($TMPackageM);

    }

    public function buyPackage(Request $request, Zarinpal $zarinpal)
    {

        $validData = $this->validate($request, [
                'user_id' => 'required|exists:users,id',
                'package_id' => 'required|exists:TM_package,id',
                'price' => 'integer',
            ]
        );

        $TMPackageM = TMPackage::find($validData['package_id']) ;


        $traO = DB::table('information_schema.tables')
            ->selectRaw('AUTO_INCREMENT as ai')
            ->where('table_name', 'transactions')->first() ;

        $id  = $traO->ai ;

//        $CallbackURL = 'http://anif.ir/verify?transaction_id='.$id.'&payment=zarinpal';  // Required
        $CallbackURL = route('payment-verify', [
            'transaction_id' => $id,
            'payment' => 'zarinpal',
        ]);  // Required

        $amount = $TMPackageM->price - $TMPackageM->price / 100 * $TMPackageM->off ;
        if(isset($request['price']))
            $amount = $validData['price'] - $validData['price'] / 100 * $TMPackageM->off ;

        $payment = [
            'CallbackURL' => $CallbackURL, // Required
            'Amount'      => $amount,                    // Required
            'Description' => 'خرید شارژ تی ام',   // Required
            'Email'       => 'h.ehsan24@gmail.com',    // Optional
            'Mobile'      => '09217265472'            // Optional
        ];
        $response = $zarinpal->request($payment);
        if($response['Status'] === 100)
        {
            Transaction::create([
                'fk' => $validData['package_id'] ,
                'model' => 'TM_package' ,
                'code' => rand(100000000, 999999999) ,
                'amount' => $amount,
                'user_id' => $validData['user_id'],
                'method_id' => 6,
            ]);
            $authority = $response['Authority'];
            return $zarinpal->redirect($authority);
        }
        return 'Error,
        Status: '.$response['Status'].',
        Message: '.$response['Message'];

    }

}
