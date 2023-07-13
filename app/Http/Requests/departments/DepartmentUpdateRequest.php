<?php

namespace App\Http\Requests\departments;

use App\DTO\Department\DepartmentDTO;
use App\Http\Requests\BaseRequest;

class DepartmentUpdateRequest extends BaseRequest
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
            'name' => 'required|string',
        ];
    }

    public function toDepartmentDTO(): \App\DTO\BaseDTO|DepartmentDTO
    {
        return DepartmentDTO::fromArray($this->all());
    }
}
