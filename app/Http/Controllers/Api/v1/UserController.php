<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ApiLogin;
use App\Http\Requests\SendVerifyCode;
use App\Http\Requests\v1\ApiEditUserInfo;
use App\Http\Resources\v1\User as UserResource;
use App\TmpRegister;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Morilog\Jalali\jDateTime;
use phpDocumentor\Reflection\Types\Integer;


class UserController extends apiController
{
    public function login(ApiLogin $request)
    {
        $validData = $this->validate($request, [
                'email' => 'exists:users',
                'phone_number' => 'exists:users',
                'password' => 'required'
            ]
        );

//        $validData = $request->validate();
//        dd($validData);

        if(! auth()->attempt($validData))
        {
            $message = 'رمز عبور یا شماره همراه اشتباه می باشد';
            return $this->respondValidationError('The server understood the request but refuses to authorize it.', $message);
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
        $user->save();

        $user = new UserResource($user);
        return $this->respondTrue($user);
    }

    public function sendVerifyCode(SendVerifyCode $request)
    {
        $validData = $this->validate($request, [

            'phone_number' => 'required|string|size:11|unique:users',
        ]);

//        $validData = $request->validate();

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

    public function get()
    {
        $userM = auth()->user();
        $userM = new UserResource($userM);
        return $this->respondTrue($userM);
    }

    public function editInfo(ApiEditUserInfo $request)
    {
        $validData = $this->validate($request, [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'user_name' => 'string|max:25|unique:users',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6', //old password set
            'TM_password' => 'string|min:4|max:6', //old password set

        ]);
        $userM = auth()->user() ;

        if(isset($request['birthday']))
        {
            $birthday = explode('/', $request['birthday']);
            $GregorianB = jDateTime::toGregorianDate($birthday[0], $birthday[1], $birthday[2]);
            $validData['birthday'] = $GregorianB ;
        }

        if(isset($request['TM']) || isset($request['all_TM'])
            || isset($request['status']) || isset($request['anif_code']) || isset($request['type']))
        {
            $message = 'دسترسی غیر مجاز';
            return $this->respondValidationError('Not Allowed.', $message);
        }
        if(isset($validData['password']) && isset($request['old_password']))
        {

            if(! Hash::check($request['old_password'], $userM->password))
            {
                $message = 'رمز عبور اشتیاه می باشد.';
                return $this->respondValidationError('The server understood the request but refuses to authorize it.', $message);
            }
            else
                $validData['password'] = bcrypt($validData['password']);
        }
        else if(isset($validData['TM_password']) && isset($request['old_TM_password']))
        {

            if(! Hash::check($request['old_TM_password'], $userM->TM_password))
            {
                $message = 'رمز استفاده از تی ام ها اشتباه می باشد';
                return $this->respondValidationError('The server understood the request but refuses to authorize it.', $message);
            }
            else
                $validData['TM_password'] = bcrypt($validData['TM_password']);
        }

        $userM->update($validData);

        $user = new UserResource($userM);
        return $this->respondTrue($user);
    }


    public function loginAdmin(ApiLogin $request)
    {
        $validData = $this->validate($request, [
                'email' => 'exists:users',
                'phone_number' => 'exists:users',
                'password' => 'required',
            ]
        );


        if(! auth()->attempt($validData))
        {
            $message = 'رمز عبور یا شماره همراه اشتباه می باشد';
            return $this->respondValidationError('The server understood the request but refuses to authorize it.', $message);
        }
        else if(auth()->user()->type < 1)
        {
            return $this->respondSuccessMessage('Unauthorized access level.', 'سطح دسترسی غیر مجاز');
        }

        auth()->user()->update(
            [
                'api_token' => Str::random(100)
            ]
        );

        $user = new UserResource(auth()->user());
        return $this->respondTrue($user);
    }

    public function getUserWAdmin(Request $request)
    {

        $validData = $this->validate($request, [
                'anif_code' => 'exists:users,anif_code',
                'password' => 'required',
            ]
        );

        if(auth()->user()->type < 1)
        {
            return $this->respondSuccessMessage('Unauthorized access level.', 'سطح دسترسی غیر مجاز');
        }

        $userCustomer = User::where('anif_code', $validData['anif_code'])->first();
        if($userCustomer)
        {
            if(Hash::check($validData['password'],$userCustomer->TM_password))
            {
                $user = new UserResource($userCustomer);
                return $this->respondTrue($user);
            }

            $message = 'رمز تی ام یا آنیف کد مطابقت ندارد از طریق اپلیکیشن از کاربر بخواهید بررسی کند';
            return $this->respondValidationError('The server understood the request but refuses to authorize it.', $message);

        }
        $this->respondSuccessMessage('Not founded user', 'کاربری با این مشخصات یافت نشد') ;
    }



}
