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
            'company_id' => [
                'required',
                Rule::unique('price_tables')->where(function ($query){
                    return $query->where('location_from', $this->location_from)->where('location_to', $this->location_to);
                }),
            ],
            'location_from' =>'required|exists:locations,id',
            'location_to' => 'required|exists:locations,id',
            'price' => 'required|integer',
            'basic_kg' => 'required|numeric',
            'additional_kg_price' => 'required|numeric',
            'return_price' => 'nullable|numeric',
            'special_price' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
          'company_id.required'=>'please select company',
          'company_id.unique'=>'this company with selected location (from and to ) already exists',
        ];
    }

    public function toPriceTableDTO(): \App\DTO\BaseDTO|PriceTableDTO
    {
        return PriceTableDTO::fromRequest($this);
    }
}
