<?php

namespace App\Http\Requests\Companies;

use App\DTO\Company\CompanyDTO;
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
            'phone'=> 'required|integer|unique:companies,phone',
            'show_dashboard'=> 'required|boolean',
            'notes'=> 'required|string',
            'status'=> 'required|boolean',

            'city_id'=> 'required|integer|exists:locations,id',
            'area_id'=> 'required|integer|exists:locations,id',
            'address'=> 'required|string',

            'branches'=> 'required|array',
            'departments'=> 'required|array',
        ];
    }

    public function toCompanyDTO(): \App\DTO\BaseDTO
    {
        return CompanyDTO::fromRequest($this);
    }
}
