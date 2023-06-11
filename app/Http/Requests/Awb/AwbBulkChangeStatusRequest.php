<?php

namespace App\Http\Requests\Awb;

use App\Http\Requests\BaseRequest;

class AwbBulkChangeStatusRequest extends BaseRequest
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
            'ids'=>'required|array',
            'status'=>'required|exists:awb_statuses,id',
        ];
    }

}
