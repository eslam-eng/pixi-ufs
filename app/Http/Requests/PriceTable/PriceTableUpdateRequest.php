<?php

namespace App\Http\Requests\PriceTable;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'company_id' => ['required',
                Rule::unique('price_tables')->where(function ($query) {
                    return $query->where('location_from', $this->location_from)
                        ->where('location_to', $this->location_to);
                })->ignore($this->company_id)
            ],
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
