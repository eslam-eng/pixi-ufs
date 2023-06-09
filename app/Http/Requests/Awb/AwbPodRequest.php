<?php

namespace App\Http\Requests\Awb;

use App\Enums\AwbStatuses;
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'actual_recipient'=>'required|string',
            'title'=>'nullable|string',
            'card_number'=>'nullable|string|min:14|max:14',
            'images'=>'nullable|array',
            'images.*'=>'required|image|mimes:png,jpg',
            'lat'=>'nullable|string',
            'lng'=>'nullable|string',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['status'=>AwbStatuses::DELIVERED()]);
    }

}
