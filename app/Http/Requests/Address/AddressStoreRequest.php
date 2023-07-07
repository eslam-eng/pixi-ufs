<?php

namespace App\Http\Requests\Address;

use App\DTO\Address\AddressDTO;
use App\Http\Requests\BaseRequest;

class AddressStoreRequest extends BaseRequest
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
            'addressable_type'=>'required|integer',
            'addressable_id'=>'required|integer',
            'lat'=>'nullable|numeric',
            'lng'=>'nullable|numeric',
            'address'=>'required|string',
            'map_url'=>'nullable|url',
            'city_id'=>'required|integer|exists:locations,id',
            'area_id'=>'required|integer|exists:locations,id',
            'postal_code'=>'nullable|string',
            'is_default'=>'nullable|string',
        ];
    }

    public function toAddressDTO(): \App\DTO\BaseDTO
    {
        return AddressDTO::fromRequest($this);
    }
}
