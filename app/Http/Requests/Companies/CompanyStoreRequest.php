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
            'phone'=> 'required|numeric|unique:companies,phone',
            'show_dashboard'=> 'nullable|boolean',
            'notes'=> 'nullable|string',
            'status'=> 'nullable|boolean',
            'num_custom_fields'=>'required|integer',
            'importation_type'=>'required|integer|in:'.ImportTypeEnum::AWBWITHREFERENCE->value.','.ImportTypeEnum::AWBWITHOUTREFERENCE->value,
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'address' => 'required|string',

            'branches_name'=> 'nullable|array',
            'branches_name.*'=> 'required|string',
            'branches_phone'=> 'nullable|array',
            'branches_phone.*'=> 'required|string',
            'branches_address'=> 'nullable|array',
            'branches_address.*'=> 'required|string',
            'branches_status'=> 'nullable|array',
            'branches_status.*'=> 'nullable|boolean',
            'branches_city_id'=> 'nullable|array',
            'branches_city_id.*'=> 'required|string',
            'branches_area_id'=> 'nullable|array',
            'branches_area_id.*'=> 'required|string',
            'departments_name'=> 'nullable|array',
            'departments_name.*'=> 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'branches_name.*'=> trans('app.branch_name_is_required'),
            'branches_phone.*'=> trans('app.branch_phone_is_required'),
            'branches_address.*'=> trans('app.branch_address_is_required'),
            'branches_city_id.*'=> trans('app.branch_city_is_required'),
            'branches_area_id.*'=> trans('app.branch_area_is_required'),
            'departments_name.*'=> trans('app.department_name_is_required'),
        ];
    }

    public function toCompanyDTO(): \App\DTO\BaseDTO
    {
        return CompanyDTO::fromRequest($this);
    }
}
