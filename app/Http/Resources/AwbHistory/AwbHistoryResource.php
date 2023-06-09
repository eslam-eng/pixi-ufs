<?php

namespace App\Http\Resources\AwbHistory;

use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\JsonDecoder;

class AwbHistoryResource extends JsonResource
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
            'id'=>$this->id,
            'from'=>$this->whenLoaded('company', [
                'company_name'=>null,
            ]),
            'receiver_data'=>json_decode($this->receiver_data),
            'shipment_info'=>[
                'weight'=>$this->weight,
                'peice'=>$this->weight,
                'shipment_type'=>$this->shipment_type,
                'code'=>$this->code,
                'status'=>$this->whenLoaded('latestStatus', $this->latestStatus->status->name),
            ],
            'payment_info'=>[
                'payment_type'=>$this->payment_type,
                'collection'=>$this->collection,
            ],
        ];
    }
}
