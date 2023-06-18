<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Notification\StoreFcmTokenRequest;
use App\Http\Resources\AuthUserResource;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->loginWithEmailOrPhone(identifier: $request->identifier, password: $request->password);
            if (isset($request->fcm_token))
                $this->authService->setUserFcmToken($user,$request->fcm_token);
            $token = $user->getToken();
            $data = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user'=>new AuthUserResource($user)
            ];
            return apiResponse(data: $data);
        } catch (NotFoundException $e) {
            return apiResponse($e->getMessage(), $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse($e->getMessage(), 'there is an error please try again later', code: 422);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return apiResponse(message: __('lang.logout_success'));
    }

    public function setFcmToken(StoreFcmTokenRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = auth()->user() ;
        $this->authService->setUserFcmToken($user , $request->fcm_token);
        return apiResponse(message: trans('lang.success_operation'));
    }

    public function getProfileDetails()
    {
        try {
            $user = auth('sanctum')->user()->load('attachments');
            if(!$user)
                throw new Exception(trans('app.unauthorized'));
            return apiResponse(data: AuthUserResource::make($user), message: trans('app.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function destroy()
    {
        try {
            $user = auth('sanctum')->user();
            if(!$user)
                throw new Exception(trans('app.unauthorized'));
            $status = $this->authService->destroy(user: $user);
            if($status)
                return apiResponse(message: trans('app.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = auth('sanctum')->user();
            if(!$user)
                throw new Exception(trans('app.unauthorized'));
            $status = $this->authService->changePassword(user: $user, data: $request->validated());
            if($status)
                return apiResponse(message: trans('app.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }
}
