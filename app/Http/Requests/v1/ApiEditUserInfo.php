<?php

namespace App\Http\Requests\v1;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class ApiEditUserInfo extends FormRequest
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
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'user_name' => 'string|max:25',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6', //old password set
            'TM_password' => 'string|min:4|max:6', //old password set
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $apiObject = new apiController();
        $vMessage = $validator->errors()->first();
        $errorMessageUnique = $apiObject->respondWithError('not valid request', $vMessage);
        throw new HttpResponseException($errorMessageUnique);
    }
}
