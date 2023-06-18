<?php

namespace App\Http\Requests\PriceTable;

use App\DTO\PriceTable\PriceTableDTO;
use App\Http\Requests\BaseRequest;

class IncreaseCompanyPriceRequest extends BaseRequest
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
            'increase_percentage' => 'required|numeric',
        ];
    }
}
