<?php

namespace App\Http\Controllers;

use App\User;
use App\TmpRegister;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string|size:11|unique:users',
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'password' => bcrypt($request['password']),
            'api_token' => Str::random(100),
        ]);

        $anifCode = $user['id'] +809 ;
        
        $user['anif_code'] = $anifCode;
        
        $user->save();

        return response()->json(true);
    }

    public function checkVerifyCode(Request $request)
    {
        $phone = $request['phone_number'];
        $verify_code = $request['verify_code'];

        if($phone && $verify_code){
            $exists = TmpRegister::where('phone_number' , $phone)->where('code' , $verify_code)->get();
            if(!count($exists) == 0)
                return response()->json($exists);
        }
        return response()->json( [
            'errors' => [
                'verify' => 'کد وارد شده صحیح نمیباشد .',
            ]
        ], 422 );
    }
    
    public function sendVerifyCode(Request $request)
    {
        $validData = $this->validate($request, [
            'phone_number' => 'required|string|size:11|unique:users',
        ]);
        $phone = $request->phone_number;
        if($phone){
            $verifyCode = rand(1000,9999);//کد رند در دیتابیس ذخیره شود
        

            $url = 'https://api.kavenegar.com/v1/6D4C4566376F6C69644B37355A566849477A702B73513D3D/verify/lookup.json?receptor='.$phone.'&token='.$verifyCode.'&template=Verify';

            $result = file_get_contents($url, false);


            $resultArray = json_decode($result, true);
            $status = $resultArray['return']['status'];


            if($status == 200)//پیام با موفقیت ارسال شده است
            {
                TmpRegister::create([
                    'phone_number' => $phone,
                    'code' => $verifyCode
                ]);

                $register = [
                    'phone_number' => $phone,
                    'code' => $verifyCode,
                    'message' => "پیام ارسال شد"
                ];

                return response()->json($register);

            }else
            {
                //$this->setStatusCode(501);
                $register = [
                    'message' => "پیغام ناموفق بود",
                ];
                return response()->json($register);
            }
        }
        return response()->json($phone);
    }
}
