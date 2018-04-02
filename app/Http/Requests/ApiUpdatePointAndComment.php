<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiUpdatePointAndComment extends FormRequest
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
//            'store_id' => 'required','exists:stores,id',
            'point_id' => 'required', 'exists:store_points,id',
            'text' => 'required'
        ];
    }

    public function messages()
    {

        return [
//            'store_id.exists' => 'شماره شناسایی مجموعه نامعتبر می باشد',
//            'store_id.required' => 'شماره شناسایی مجموعه مورد نیاز می باشد.',
            'point_id.exists' => 'شماره شناسایی امتیاز نامعتبر می باشد',
            'point_id.required' => 'شماره شناسایی امتیاز مورد نیاز می باشد.',
            'text.required' => 'فیلد متن الزامی می باشد',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $apiObject = new apiController();
        $vMessage = $validator->errors()->first();
        $errorMessageUnique = $apiObject->respondWithError('error', $vMessage);
        throw new HttpResponseException($errorMessageUnique);
    }
}
