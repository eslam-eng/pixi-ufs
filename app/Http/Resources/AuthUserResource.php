<?php

namespace App\Http\Resources;

use App\Enums\UsersType;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'show_dashboard'=>$this->show_dashboard,
            'phone'=>$this->phone,
            'type'=>$this->type,
            'status'=>$this->status,
            'profile_image'=>$this->whenLoaded('attachments',
                $this->attachments()->where('type', \App\Enums\AttachmentsType::PRIMARYIMAGE->value)->count() ?
                new AttachmentsResource(
                    $this->attachments->where('type', \App\Enums\AttachmentsType::PRIMARYIMAGE->value)->first()
                ):
                array('path'=>asset('assets/images/default-image.jpg')),
                
            ),
            'permissions'=>$this->when($this->type != UsersType::SUPERADMIN() , $this->getPermissionNames())
        ];
    }
}
