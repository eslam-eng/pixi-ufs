<?php

namespace App\Http\Requests\Receivers;

use App\DTO\Receiver\ReceiverDTO;
use App\Http\Requests\BaseRequest;

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
            'phone' => 'required|numeric|unique:receivers,phone,' . $this->receiver,
            'receiving_company' => 'nullable|string',
            'branch_id' => 'required|integer|exists:branches,id',
            'reference' => 'nullable|string|unique:receivers,reference,' . $this->receiver,
            'title' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }

    public function toReceiverDTO(): \App\DTO\BaseDTO|ReceiverDTO
    {
        return ReceiverDTO::fromArray($this->all());
    }
}
