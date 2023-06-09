<?php

namespace App\Http\Resources\PushNotification;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = getLocale();
       return [
           'id'=>$this->id,
           'model_id'=>$this->data['model_id'],
           'type'=>$this->data['type'],
           'title'=>$this->data['title']["$lang"]??null,
           'message'=>$this->data['message']["$lang"]??null,
           'read_at'=> isset($this->read_at),
           'created_at'=>Carbon::parse($this->created_at)->diffForHumans()
           ];
    }

}
