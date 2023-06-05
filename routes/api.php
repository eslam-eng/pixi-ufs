<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AwbController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/user/profile', [AuthController::class, 'getProfileDetails']);
    Route::get('/user/destroy', [AuthController::class, 'destroy']);
    Route::post('/user/change-password', [AuthController::class, 'changePassword']);
});
Route::post('/auth/login',[AuthController::class, 'login']);
Route::get('/awbs', [AwbController::class, 'index']);
Route::post('/awbs/details/{id}', [AwbController::class, 'awbDetails']);
Route::post('/awbs/cancel/{id}', [AwbController::class, 'cancelAwb']);
Route::post('/awbs/reschedule/{id}', [AwbController::class, 'awbReschedule']);
Route::post('/awbs/update-phone/{id}', [AwbController::class, 'updateReceiverPhone']);
Route::post('/awbs/add-phone-and-address/{id}', [AwbController::class, 'AddPhoneAndAddress']);
Route::resource('addresses', AddressController::class);