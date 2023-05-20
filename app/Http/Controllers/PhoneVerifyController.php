<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneVerifyRequest;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetCode;
use Illuminate\Support\Facades\Mail;

class PhoneVerifyController extends Controller
{
    public function __invoke(PhoneVerifyRequest $request, PasswordResetCode $passwordResetCode)
    {
        try {
            $passwordResetCode->where('identifier', $request->identifier)->delete();
            // Create a new code
            $codeData = $passwordResetCode->create($request->data());
            if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL))
                Mail::to($codeData->identifier)->send(new ResetPasswordMail(code: $codeData->code));
            else
                // send sms

                return apiResponse(message: __('lang.code_send_successfully'));
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage());
        }

    }
}
