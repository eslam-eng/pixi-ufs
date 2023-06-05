<?php

namespace App\Http\Resources;

use App\Enums\UsersType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
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
            'permissions'=>$this->when($this->type != UsersType::SUPERADMIN() , $this->getPermissionNames())
        ];
    }

}
