<?php

namespace App\Http\Requests\Receivers;

use App\DTO\Receiver\ReceiverDTO;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ReceiverUpdateRequest extends BaseRequest
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
            'phone' => 'required|string|unique:receivers,phone',
            'receiving_company' => 'nullable|string',
            'branch_id' => 'required|numeric|exists:branches,id',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'reference' => ['nullable','string',Rule::unique('receivers','reference')->where('company_id',$this->user->company_id)->ignore($this->receiver)],
            'title' => 'nullable|string',
            'notes' => 'nullable|string',
            'address' => 'required|string',
            'lat' => 'string|nullable',
            'lng' => 'string|nullable',
            'postal_code' => 'string|nullable',
            'map_url' => 'string|nullable',
        ];
    }

}
