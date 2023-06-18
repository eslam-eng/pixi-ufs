<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PhoneVerifyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => ['required',Rule::exists('users','email')->where(fn($query) => $query->where('email', $this->identifier)->orWhere('phone', $this->identifier))]
        ];
    }

    /**
     * the data of above request
     *
     * @return array
     */
    public function data()
    {
        return [
            'identifier' => request()->identifier,
            'code' => mt_rand(100000, 999999),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
