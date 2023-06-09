<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Notification\StoreFcmTokenRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function loginForm()
    {
        return view('layouts.dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $this->authService->loginWithEmailOrPhone(identifier: $request->identifier, password: $request->password);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.login_successfully')
            ];
            return to_route('home')->with('toast', $toast);
        } catch (Exception|NotFoundException $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return to_route('login')->with('toast', $toast);
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function setFcmToken(StoreFcmTokenRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = auth()->user();
        $this->authService->setUserFcmToken($user, $request->fcm_token);
        return apiResponse(message: trans('lang.success_operation'));
    }
}
