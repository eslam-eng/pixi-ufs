<?php

namespace App\Http\Resources\Awb;

use Illuminate\Http\Resources\Json\JsonResource;

class AwbStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'total_shipments'=> $this->count(),
            'collecting'=> $this->sum('collection'),
            'returned'=> $this->sum('is_return'),
            'your_commission'=> $this->sum('is_return'),
            'overdue'=> 0,
            'waited_for_collected'=> 0,
        ];
    }
}
