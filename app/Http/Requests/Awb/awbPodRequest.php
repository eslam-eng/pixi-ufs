<?php

namespace App\Http\Requests\Awb;

use App\Http\Requests\BaseRequest;

class AwbPodRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'actual_recipient'=>'required|string',
            'card_number'=>'nullable|string|min:14|max:14',
            'title'=>'nullable|string',
            'images'=>'nullable|array',
            'images.*'=>'required|image|mimes:png,jpg',
        ];
    }

}
