<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AwbController;
use App\Http\Controllers\Api\AwbHistoryController;
use App\Http\Controllers\Api\AwbStatusController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PhoneVerifyController;
use App\Http\Controllers\Api\ReceiverController;
use App\Http\Controllers\Api\RestPasswordController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('phone/verify', PhoneVerifyController::class);
    Route::post('password/forget', PhoneVerifyController::class);
    Route::post('password/reset', RestPasswordController::class);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('user/set-fcm-token', [AuthController::class, 'setFcmToken']);
        Route::get('user', [AuthController::class, 'authUser']);
        Route::patch('user', [AuthController::class, 'update']);
    });
});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('profile', [AuthController::class, 'getProfileDetails']);
        Route::get('/destroy', [AuthController::class, 'destroy']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);

    });


    Route::group(['prefix' => 'awbs'], function () {
        Route::get('/', [AwbController::class, 'index']);
        Route::get('/all-status', [AwbStatusController::class, 'index']);
        Route::get('/details/{id}', [AwbController::class, 'awbDetails']);

    });

    Route::group(['prefix' => 'awb-history'], function () {
        Route::post('{awb_id}', [AwbHistoryController::class, 'changeStatus']);
    });

    Route::post('update-device-token', [UsersController::class, 'updateDeviceToken']);

    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/send', [NotificationController::class, 'sendFcmNotification']);
        Route::get('/', [NotificationController::class, 'getNotifications']);
        Route::get('/{notification_id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    });

    Route::group(['prefix' => 'receivers'], function () {
        Route::post('/update-phone/{id}', [ReceiverController::class, 'updateReceiverPhone']);
        Route::post('/update-address/{id}', [ReceiverController::class, 'updateReceiverAddress']);
        Route::post('/update-phone-and-address/{id}', [ReceiverController::class, 'AddPhoneAndAddress']);
    });

    Route::group(['prefix' => 'locations'], function () {
        Route::get('cities', [LocationsController::class, 'getAllCities']);
        Route::get('{parent_id}', [LocationsController::class, 'getLocationByParentId']);
    });
});

Route::fallback(function () {
    return apiResponse(message: 'Invalid Route', code: 404);
});
