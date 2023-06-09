<?php

namespace App\Http\Requests\Awb\Api;

use App\Http\Requests\BaseRequest;

class AwbChangeStatusRequest extends BaseRequest
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
            'status'=>'required|exists:awb_statuses,id',
            'lat'=>'nullable|string',
            'lng'=>'nullable|string',
            'comment'=>'nullable|string',
        ];
    }

}
