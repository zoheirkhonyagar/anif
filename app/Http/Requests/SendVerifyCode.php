<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SendVerifyCode extends FormRequest
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
            'phone_number' => 'required|string|size:11|unique:users',
        ];
    }

    public function messages()
    {

        return [
            'phone_number.required' => 'شماره همراه رو وارد کنید',
            'phone_number.unique' => 'شماره همراه در سیستم ثبت می باشد',
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
