<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AwbController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PhoneVerifyController;
use App\Http\Controllers\Api\RestPasswordController;
use App\Http\Controllers\Api\UsersController;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;
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
    Route::group(['middleware' => 'auth:sanctum'],function (){
        Route::post('user/set-fcm-token', [AuthController::class, 'setFcmToken']);
        Route::get('user', [AuthController::class, 'authUser']);
        Route::patch('user', [AuthController::class, 'update']);
    });
});


Route::group(['middleware' => 'auth:sanctum'],function (){

    Route::group(['prefix' => 'awbs'],function (){
        Route::get('/', [AwbController::class, 'index']);
        Route::post('/details/{id}', [AwbController::class, 'awbDetails']);
        Route::post('/status/{id}', [AwbController::class, 'status']);
        Route::post('/update-phone/{id}', [AwbController::class, 'updateReceiverPhone']);
        Route::post('/add-phone-and-address/{id}', [AwbController::class, 'AddPhoneAndAddress']);
    });

    Route::post('update-device-token',[UsersController::class,'updateDeviceToken']);

    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/send', [NotificationController::class, 'sendFcmNotification']);
        Route::get('/', [NotificationController::class, 'getNotifications']);
        Route::get('/{notification_id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    });

});

Route::resource('addresses', AddressController::class);
