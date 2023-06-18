<?php

namespace App\Http\Resources\Awb;

use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use PhpParser\JsonDecoder;

class AwbResource extends JsonResource
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
            'code'=>$this->code,
            'company'=>$this->company->name,
            'status'=>$this->latestStatus->status->name,
            'receiver_id'=>Arr::get($this->receiver_data,'id'),
            'receiver_name'=>$this->receiver_data['name'],
            'receiver_phone'=>$this->receiver_data['phone1'],
            'receiver_city'=>$this->receiverCity?->title,
            'receiver_area'=>$this->receiverArea?->title,
            'receiver_address'=>$this->receiver_data['address1'],
        ];
    }
}
