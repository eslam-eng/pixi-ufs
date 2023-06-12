<?php

namespace App\Http\Requests\PriceTable;

use App\DTO\PriceTable\PriceTableDTO;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class PriceTableStoreRequest extends BaseRequest
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
            'location_from' =>'required|exists:locations,id',
            'location_to' => 'required|exists:locations,id',
            'price' => 'required|integer',
            'basic_kg' => 'required|numeric',
            'additional_kg_price' => 'required|numeric',
            'return_price' => 'nullable|numeric',
            'special_price' => 'nullable|numeric',
        ];
    }

    public function toPriceTableDTO(): \App\DTO\BaseDTO|PriceTableDTO
    {
        return PriceTableDTO::fromRequest($this);
    }
}
