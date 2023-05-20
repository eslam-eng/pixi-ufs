<?php

namespace App\Http\Resources\Receiver;

use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiverEditResource extends JsonResource
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
            'company_id' => $this->company_name,
            'branch_id' => $this->branch_id,
            'reference' => $this->reference,
            'title' => $this->title,
            'addresses'=>AddressResource::collection($this->whenLoaded('addresses'))
        ];
    }
}
