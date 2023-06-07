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
            'receiver_data'=>$this->receiver_data['name'],
        ];
    }
}
