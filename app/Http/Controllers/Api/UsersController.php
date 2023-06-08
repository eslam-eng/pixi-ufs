<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreFcmTokenRequest;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function __construct(public UsersService $usersService)
    {
    }

    public function updateDeviceToken(StoreFcmTokenRequest $tokenRequest)
    {
        try {
            $this->usersService->setUserFcmToken($tokenRequest->fcm_token);
            return apiResponse(message: 'token updated_successfully');
        }catch (\Exception $exception)
        {
            return apiResponse(message: 'there is an error');
        }
    }
}
