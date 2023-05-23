<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\Emptypage;
use \App\Http\Livewire\Switcherpage;
use App\Http\Controllers\ReceiverController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'authentication','middleware' => 'guest'],function (){
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('singin',[AuthController::class, 'login'])->name('singin');
});

Route::get('/', function () {
    return view('livewire.index');
})->name('home')->middleware('auth');
//auth routes
Route::group(['prefix' => 'dashboard','middleware' => 'auth'],function (){
    Route::get('/', function () {
        return view('livewire.index');
    })->name('home');

    Route::resource('receivers',ReceiverController::class);
    Route::group(['prefix' => 'addresses' ],function (){
        Route::get('{id}/type/{type}',[AddressController::class,'create'])->name('addresses.create');
        Route::get('{id}/set-default',[AddressController::class,'create'])->name('addresses.set-default');
        Route::get('{id}/edit',[AddressController::class,'edit'])->name('address.edit');
        Route::put('{id}',[AddressController::class,'update'])->name('address.update');
    });
    Route::get('emptypage', Emptypage::class)->name('emptypage');

    Route::get('switcherpage', Switcherpage::class)->name('switcherpage');
});


