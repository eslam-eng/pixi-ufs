<?php

namespace App\Http\Requests\Receivers;

use App\DTO\Receiver\ReceiverDTO;
use App\Http\Requests\BaseRequest;

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
            'phone' => 'required|string|unique:receivers,phone',
            'receiving_company' => 'nullable|string',
            'branch_id' => 'required|numeric|exists:branches,id',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'reference' => 'nullable|string|unique:receivers,reference',
            'title' => 'nullable|string',
            'notes' => 'nullable|string',
            'address' => 'required|string',
            'lat' => 'string|nullable',
            'lng' => 'string|nullable',
            'postal_code' => 'string|nullable',
            'map_url' => 'string|nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_default' => true,
        ]);

    }

    public function toReceiverDTO(): \App\DTO\BaseDTO
    {
        return ReceiverDTO::fromRequest($this);
    }
}
