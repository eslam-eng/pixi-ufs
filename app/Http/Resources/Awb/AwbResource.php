<?php

namespace App\Http\Resources\Awb;

use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;
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
            'receiver_name'=>$this->receiver_data['name'],
            'receiver_phone'=>$this->receiver_data['phone1'],
            'receiver_area'=>$this->receiver_data['area'],
            'receiver_address'=>$this->receiver_data['address1'],
        ];
    }
}
