<?php

namespace App\Http\Requests\Awb;

use App\DTO\Address\AddressDTO;
use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class AwbStoreRequest extends BaseRequest
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
            'user_id'=>'required|integer|exists:users,id',
            'company_id'=>'required|integer|exists:companies,id',
            'branch_id'=>'required|integer|exists:branches,id',
            'department_id'=>'required|integer|exists:departments,id',
            'receiver_id'=>'required|integer|exists:receivers,id',
            'shipment_type_id'=>'required|integer|exists:company_shipment_types,id',
            'service_type_id'=>'integer|required',
            'payment_type'=>'nullable|string',
            'collection'=>'nullable|numeric',
            'is_return'=>'nullable|bool',
            'weight'=>'required|numeric',
            'pieces'=>'required|numeric',
            'custom_field1'=>'nullable|string',
            'custom_field2'=>'nullable|string',
            'custom_field3'=>'nullable|string',

            'length'=>'sometimes|required|array',
            'length.*'=>'required',

            'width'=>'sometimes|required|array',
            'width.*'=>'required',

            'height'=>'sometimes|required|array',
            'height.*'=>'required',

        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'is_return'=>(bool)($this->is_reverse)??false ,
            'user_id'=>auth()->id(),
        ]);
    }
}
