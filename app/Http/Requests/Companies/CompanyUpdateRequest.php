<?php

namespace App\Http\Requests\Companies;

use App\DTO\Company\CompanyDTO;
use App\Enums\ImportTypeEnum;
use App\Http\Requests\BaseRequest;

class CompanyUpdateRequest extends BaseRequest
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
            'name'=> 'required|string',
            'email'=> 'required|email|unique:companies,email,'.$this->company,
            'ceo'=> 'nullable|string',
            'phone'=> 'required|numeric|unique:companies,phone,'.$this->company,
            'show_dashboard'=> 'nullable|boolean',
            'notes'=> 'nullable|string',
            'status'=> 'nullable|boolean',

            'num_custom_fields'=>'required|integer',
            'importation_type'=>'nullable|integer|in:'.ImportTypeEnum::AWBWITHREFERENCE->value.','.ImportTypeEnum::AWBWITHOUTREFERENCE->value,
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'address' => 'required|string',
        ];
    }

    public function toCompanyDTO(): \App\DTO\BaseDTO
    {
        return CompanyDTO::fromRequest($this);
    }
}
