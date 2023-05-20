<?php

namespace App\Services;

use App\Enums\ActivationStatus;
use App\Exceptions\NotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AuthService extends BaseService
{

    public function __construct(public User $model)
    {
    }

    public function loginWithEmailOrPhone(string $identifier, string $password): User|Model
    {

        $identifierField = is_numeric($identifier) ? 'phone' : 'email';
        $credential = [$identifierField => $identifier, 'password' => $password , 'status'=>ActivationStatus::ACTIVE()];
        if (!auth()->attempt($credential))
            return throw new NotFoundException(__('lang.login_failed'));
        return $this->model->where($identifierField, $identifier)->first();
    }


    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function setUserFcmToken(User $user, $fcm_token): void
    {
        $user->update(['fcm_token' => $fcm_token]);
    }
}
