<?php

namespace App\Http\Requests\Companies;

use App\DTO\Company\CompanyDTO;
use App\Enums\ImportTypeEnum;
use App\Http\Requests\BaseRequest;

class CompanyStoreRequest extends BaseRequest
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
            'email'=> 'required|email|unique:companies,email',
            'ceo'=> 'nullable|string',
            'phone'=> 'required|string|unique:companies,phone',
            'show_dashboard'=> 'nullable|boolean',
            'notes'=> 'nullable|string',
            'status'=> 'nullable|boolean',
            'store_receivers'=> 'nullable|boolean',
            'num_custom_fields'=>'required|integer',
            'importation_type'=>'nullable|integer|in:'.ImportTypeEnum::AWBWITHREFERENCE->value.','.ImportTypeEnum::AWBWITHOUTREFERENCE->value,
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'address' => 'required|string',

            'branches_name'=> 'required|array',
            'branches_name.*'=> 'required',
            'branches_phone'=> 'required|array',
            'branches_phone.*'=> 'required',
            'branches_address'=> 'required|array',
            'branches_address.*'=> 'required',
            'branches_status'=> 'required|array',
            'branches_status.*'=> 'required',
            'branches_city_id'=> 'required|array',
            'branches_city_id.*'=> 'required',
            'branches_area_id'=> 'required|array',
            'branches_area_id.*'=> 'required',
            'departments_name'=> 'required|array',
            'departments_name.*'=> 'required',
        ];
    }

    public function toCompanyDTO(): \App\DTO\BaseDTO
    {
        return CompanyDTO::fromRequest($this);
    }
}
