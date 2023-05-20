<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name'=> $this->name,
            'email'=> $this->email,
            'ceo'=> $this->ceo,
            'phone'=> $this->phone,
            'show_dashboard'=> $this->show_dashboard,
            'status'=> $this->status,
            'city_name' => $this->addresses->city_name,
            'city_id' => $this->addresses->city->id,
            'area_name' => $this->addresses->area_name,
            'area_id' => $this->addresses->area->id,
            'address'=>$this->addresses->address,
            'notes'=> $this->notes,
        ];
    }
}
