<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\User as UserResource;
use App\TmpRegister;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;


class UserController extends apiController
{


    public function login(Request $request)
    {
        $validData = $this->validate($request, [
                'email' => 'required|exists:users',
//                'phone_number' => 'required|exists:users',
                'password' => 'required'
            ]
        );

        if(! auth()->attempt($validData))
        {
            return $this->respondValidationError();
        }

        auth()->user()->update(
            [
                'api_token' => Str::random(100)
            ]
        );

        $user = new UserResource(auth()->user());
        return $this->respondTrue($user);
    }

    public function register(Request $request)
    {
        // Validation Data
        $validData = $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
//            'user_name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string|size:11|unique:users',
//            'anif_code' => 'required|numeric|unique:users',
        ]);

        $user = User::create([
            'first_name' => $validData['first_name'],
            'last_name' => $validData['last_name'],
//            'anif_code' => $validData['anif_code'],
//            'user_name' => $validData['user_name'],
            'phone_number' => $validData['phone_number'],
//            'email' => $validData['email'],
            'password' => bcrypt($validData['password']),
            'api_token' => Str::random(100),
        ]);

        $anifCode = $user['id'] +809 ;

        $user['anif_code'] = $anifCode;
        $user->save() ;

        $user = new UserResource($user);
        return $this->respondTrue($user);
    }


    public function sendVerifyCode(Request $request)
    {
        $validData = $this->validate($request, [

            'phone_number' => 'required|string|size:11|unique:users',
        ]);
        dd($validData);

        $verifyCode = rand(1000,9999);//کد رند در دیتابیس ذخیره شود
        $phoneNumber = $validData['phone_number'] ;

        $url = 'https://api.kavenegar.com/v1/6D4C4566376F6C69644B37355A566849477A702B73513D3D/verify/lookup.json?receptor='.$phoneNumber.'&token='.$verifyCode.'&template=Verify';

        $result = file_get_contents($url, false);


        $resultArray = json_decode($result, true);
        $status = $resultArray['return']['status'];


        if($status == 200)//پیام با موفقیت ارسال شده است
        {
            TmpRegister::create([
                'phone_number' => $phoneNumber,
                'code' => $verifyCode
            ]);
            return $this->respondTrue([
               'verify_code'=> $verifyCode,
                'message' => 'پیام ارسال شد'
            ]);

        }
        else
        {
            $this->setStatusCode(501);
            return $this->respondTrue([
                'message' => 'ارسال پیام ناموفق بود'
            ]);
        }

    }

}
