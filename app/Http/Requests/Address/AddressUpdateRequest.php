<?php

namespace App\Http\Requests\Address;

use App\DTO\Address\AddressDTO;
use App\Http\Requests\BaseRequest;

class AddressUpdateRequest extends BaseRequest
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
            'lat'=>'nullable|numeric',
            'lng'=>'nullable|numeric',
            'address'=>'required|string',
            'map_url'=>'nullable|url',
            'city_id'=>'required|integer|exists:locations,id',
            'area_id'=>'required|integer|exists:locations,id',
            'postal_code'=>'required|numeric',
            'is_default'=>'nullable|string',
        ];
    }

    public function toAddressDTO(): \App\DTO\BaseDTO
    {
        return AddressDTO::fromRequest($this);
    }
}
