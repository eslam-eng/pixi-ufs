<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'map_url' => $this->map_url,
            'city_name' => $this->city_name,
            'city_id' => $this->city_id,
            'area_name' => $this->area_name,
            'area_id' => $this->area_id,
            'postal_code' => $this->postal_code,
            'is_default' => $this->is_default,
        ];
    }
}
