<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AwbController;
use App\Http\Controllers\Api\AwbHistoryController;
use App\Http\Controllers\Api\CancelReasonController;
use App\Http\Controllers\Api\ReceiverController;
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
Route::post('/awbs', [AwbController::class, 'index']);
Route::get('/awbs/statistics', [AwbController::class, 'statistics']);
Route::post('/awbs/pod/{id}', [AwbController::class, 'pod']);
Route::post('/awbs/details/{id}', [AwbController::class, 'awbDetails']);
Route::post('/awbs/status/{id}', [AwbHistoryController::class, 'awbStatus']);
Route::get('/awbs/status/{id}', [AwbController::class, 'lastStatus']);
Route::post('/receivers/update-phone/{id}', [ReceiverController::class, 'updateReceiverPhone']);
Route::post('/receivers/update-address/{id}', [ReceiverController::class, 'updateReceiverAddress']);
Route::post('/receivers/update-phone-and-address/{id}', [ReceiverController::class, 'AddPhoneAndAddress']);
Route::resource('addresses', AddressController::class);