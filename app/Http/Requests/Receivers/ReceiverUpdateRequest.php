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
            'phone1' => ['required','numeric',Rule::unique('receivers','phone1')->where('company_id',$this->company_id)->ignore($this->receiver)],
            'phone2' => 'nullable|numeric',
            'receiving_company' => 'nullable|string',
            'receiving_branch' => 'nullable|string',
            'company_id' => 'required|numeric|exists:companies,id',
            'branch_id' => 'required|numeric|exists:branches,id',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'reference' => ['nullable','string',Rule::unique('receivers','reference')->where('company_id',$this->company_id)->ignore($this->receiver)],
            'title' => 'nullable|string',
            'notes' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'map_url' => 'string|nullable',
        ];
    }

}
