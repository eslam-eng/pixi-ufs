<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'company_name' => $this->company_name,
            'company_id' => $this->company->id,
            'city_name' => $this->addresses->city_name,
            'city_id' => $this->addresses->city->id,
            'area_name' => $this->addresses->area_name,
            'area_id' => $this->addresses->area->id,
            'address' => $this->addresses->address
        ];
    }
}
