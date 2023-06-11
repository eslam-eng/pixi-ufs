<?php

namespace App\Http\Requests\PriceTable;

use App\Http\Requests\BaseRequest;

class PriceTableUpdateRequest extends BaseRequest
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
            'company_id' => 'required',
            'location_from' => 'required|exists:locations,id',
            'location_to' => 'required|exists:locations,id',
            'price' => 'required|integer',
            'basic_kg' => 'required|numeric',
            'additional_kg_price' => 'required|numeric',
            'return_price' => 'required|numeric',
            'special_price' => 'required|numeric',
        ];
    }

}
