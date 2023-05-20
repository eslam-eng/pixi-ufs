<?php

namespace App\Http\Resources\Receiver;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'receiving_company' => $this->receiving_company,
            'company_name' => $this->company_name,
            'branch_name' => $this->branch_name,
            'city_name' => $this->defaultAddress->city_name,
            'area_name' => $this->defaultAddress->area_name,
            'reference' => $this->reference,
            'title' => $this->title,
            'address' => $this->address_name
        ];
    }
}
