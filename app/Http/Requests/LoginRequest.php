<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
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
            'identifier' => 'required|string',
            'password'   => 'required|string',
            'fcm_token'  => 'string|nullable'
        ];
    }

    public function messages()
    {
        return [
          'identifier.required'=>"email or phone required"
        ];
    }
}
