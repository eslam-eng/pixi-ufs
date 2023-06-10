<?php

namespace App\Http\Requests\Users;

use App\DTO\User\UserDTO;
use App\Http\Requests\BaseRequest;

class UserUpdateRequest extends BaseRequest
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
            'email' => 'required|email|unique:users,email,'.$this->user,
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|unique:users,phone,'.$this->user,
            'status' => 'nullable|boolean',
            'type' => 'required|integer',
            'company_id' => 'nullable|integer|exists:companies,id',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'notes' => 'nullable|string',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'address'=>'required|string',
        ];
    }

    public function toUserDTO(): \App\DTO\BaseDTO
    {
        return UserDTO::fromRequest($this);
    }
}
