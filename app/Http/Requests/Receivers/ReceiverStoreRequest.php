<?php

namespace App\Http\Requests\Receivers;

use App\DTO\Receiver\ReceiverDTO;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ReceiverStoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone1' => ['required','string',Rule::unique('receivers','phone1')->where('company_id',$this->user->company_id)],
            'phone2' => 'nullable|string',
            'receiving_company' => 'nullable|string',
            'receiving_branch' => 'nullable|string',
            'company_id' => 'required|numeric|exists:companies,id',
            'branch_id' => 'required|numeric|exists:branches,id',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'reference' => ['nullable','string',Rule::unique('receivers','reference')->where('company_id',$this->user->company_id)],
            'title' => 'nullable|string',
            'notes' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'lat' => 'string|nullable',
            'lng' => 'string|nullable',
            'map_url' => 'string|nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user' => auth()->user(),
        ]);

    }
}
