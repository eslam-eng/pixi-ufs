<?php

namespace App\Http\Requests\Awb;

use App\DTO\Address\AddressDTO;
use App\DTO\AwbHistory\AwbHistoryDTO;
use App\Http\Requests\BaseRequest;

class AwbCancelRequest extends BaseRequest
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
            'comment'=>'required|string',
        ];
    }

}
