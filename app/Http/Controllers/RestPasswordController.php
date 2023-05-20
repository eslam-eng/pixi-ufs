<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordResetCode;
use App\Models\ResetCodePassword;
use App\Models\User;

class RestPasswordController extends Controller
{
    /**
     * Change the password
     *
     * @param  mixed $request
     */
    public function __invoke(ResetPasswordRequest $request,PasswordResetCode $passwordResetCode): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $passwordReset = $passwordResetCode::firstWhere('code', $request->code);

        if ($passwordReset->isExpire())
            return apiResponse(message:__('lang.code_is_expire'),code: 422);

        $user = User::where('phone', $passwordReset->identifier)->orWhere('email',$passwordReset->identifier)->first();

        $user->update(['password'=>bcrypt($request->password)]);

        $passwordReset->delete();

        return apiResponse(message: __('lang.password_has_been_successfully_reset'));
    }
}
