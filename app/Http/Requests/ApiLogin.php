<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApiLogin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'exists:users',
            'phone_number' => 'exists:users',
            'password' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'phone_number.exists' => 'شماره همراه اشتباه است یا ثبت نام نشده است',
            'email.exists' => 'پست الکترونیکی اشتباه است یا ثبت نام نشده است',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $apiObject = new apiController();
        $vMessage = $validator->errors()->first();
        $errorMessageUnique = $apiObject->respondWithError('phone number not unique', $vMessage);
        throw new HttpResponseException($errorMessageUnique);
    }
}
