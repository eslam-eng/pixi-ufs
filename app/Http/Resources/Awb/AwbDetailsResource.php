<?php

namespace App\Http\Resources\Awb;

use App\Http\Resources\AttachmentsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class AwbDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'code' => $this->code,
            'company' => $this->whenLoaded('company', $this->company->name),
            'status' => $this->whenLoaded('latestStatus', $this->latestStatus->status->name),
            'stepper' => $this->whenLoaded('latestStatus', $this->latestStatus->status->stepper),
            'weight' => $this->weight,
            'pieces' => $this->pieces,
            'shipment_type' => $this->shipment_type,
            'payment_type' => $this->payment_typ,
            'service_type' => $this->service_type,
            'lat'=> Arr::get($this->receiver_data,'lat'),
            'lng'=> Arr::get($this->receiver_data,'lng'),
            'note1' => $this->note1,
            'note2' => $this->note2,
            'collection' => $this->collection,
            'receiver_id' =>  Arr::get($this->receiver_data,'id'),
            'receiver_name' => $this->receiver_data['name'],
            'receiver_phone' => $this->receiver_data['phone1'],
            'receiver_city' => $this->receiverCity?->title,
            'receiver_area' => $this->receiverArea?->title,
            'receiver_address' => $this->receiver_data['address1'],
            'profile_image'=>$this->whenLoaded('latestStatus.attachments',new AttachmentsResource($this->latestStatus->attachments),asset('assets/images/default-image.jpg')),
        ];
    }
}
