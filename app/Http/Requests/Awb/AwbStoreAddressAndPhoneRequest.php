<?php

namespace App\Http\Requests\Awb;

use App\DTO\Address\AddressDTO;
use App\Http\Requests\BaseRequest;

class AwbStoreAddressAndPhoneRequest extends BaseRequest
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
            'lat'=>'nullable|string',
            'lng'=>'nullable|string',
            'address'=>'required|string',
            'map_url'=>'nullable|url',
            'city_id'=>'required|integer|exists:locations,id',
            'area_id'=>'required|integer|exists:locations,id',
            'postal_code'=>'nullable|string',
            'is_default'=>'nullable|string',
            'phone'=>'required|string',
        ];
    }

}
