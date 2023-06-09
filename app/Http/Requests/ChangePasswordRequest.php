<?php

namespace App\Http\Requests;

class ChangePasswordRequest extends BaseRequest
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
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:6',
            'new_password'   => 'required|string|confirmed|min:6',
        ];
    }
}
