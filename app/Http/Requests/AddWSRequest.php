<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\v1\apiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddWSRequest extends FormRequest
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
            'position_id' => 'required|exists:anif_positions,id',
            'day_section_id' => 'required|exists:day_sections,id',
            'date' => 'required|date',
            'interface_id' => 'required|exists:interfaces,id',
            'user_id' => 'exists:users,id',
            'unique_code' => 'required',
        ];
    }


    public function messages()
    {

        return [
            'user_id.exists' => 'کاربر با این شماره موجود نمی باشد',
            'position_id.required' => 'ارسال شماره بخش الزامی می باشد',
            'day_section_id.required' => 'ارسال وضعیت روز الزامی می باشد',
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
