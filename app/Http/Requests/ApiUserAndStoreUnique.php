<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApiUserAndStoreUnique extends FormRequest
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

              'store_id' => 'required|unique:customers,store_id,NULL,id,user_id,'.auth()->user()->id,
        ];

    }

    public function messages()
    {

        return [
            'store_id.unique' => 'شما در این مجموعه عضو می باشید.',
            'store_id.required' => 'شماره شناسایی مجموعه مورد نیاز می باشد.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $apiObject = new apiController();
        $vMessage = $validator->errors()->first();
        $errorMessageUnique = $apiObject->respondWithError('store_id and user_id not unique', $vMessage);
        throw new HttpResponseException($errorMessageUnique);
    }
}
