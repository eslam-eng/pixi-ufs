<?php

namespace App\Http\Requests\Awb;

use App\DTO\Address\AddressDTO;
use App\Http\Requests\BaseRequest;

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
            'company_id'=>'required|integer|exists:companies,id',
            'branch_id'=>'required|integer|exists:branches,id',
            'department_id'=>'required|integer|exists:departments,id',
            'receiver_id'=>'required|integer|exists:receivers,id',
            'shipment_type_id'=>'required|integer|exists:company_shipment_types,id',
            'service_type'=>'nullable|string',
            'payment_type'=>'nullable|string',
            'collection'=>'nullable|numeric',
            'is_reverse'=>'nullable|url',
            'weight'=>'required|numeric',
            'pieces'=>'required|numeric',
            'custom_field1'=>'nullable|string',
            'custom_field2'=>'nullable|string',
            'custom_field3'=>'nullable|string',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['is_reverse'=>$this->is_reverse??false]);
    }
}
