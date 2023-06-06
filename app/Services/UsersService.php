<?php

namespace App\Services;


use App\Models\User;

class UsersService extends BaseService
{
    public function __construct(public User $model)
    {
    }

    public function getModel(): User
    {
        return $this->model;
    }

    public function setUserFcmToken($fcm_token)
    {
        $user = auth('sanctum')->user();
        $user->update(['device_token' => $fcm_token]);
    }
}
