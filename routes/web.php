<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwbController;
use App\Http\Controllers\AwbHistoryController;
use App\Http\Controllers\AwbStatusController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ImportLogsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\PriceTableController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\UsersController;
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


Route::group(['prefix' => 'authentication', 'middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('signin');
});

Route::get('/', function () {
    return view('livewire.index');
})->name('/')->middleware('auth');
//auth routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('livewire.index');
    })->name('home');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'search'], function () {
        Route::get('receivers', [ReceiverController::class, 'search'])->name('receivers.search');
    });
    Route::resource('receivers', ReceiverController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class)->except('create');
    Route::resource('users', UsersController::class);
    Route::put('profile/{id}', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile', function(){
        return view('layouts.dashboard.users.profile');
    })->name('profile.index');
    Route::get('/city-area/{id}', [LocationsController::class, 'getLocationByParentId']);
    Route::get('receivers-download-template/form', [ReceiverController::class, 'importForm'])->name('receivers-download-template.form');
    Route::get('receivers-download-template', [ReceiverController::class, 'downloadReceiversTemplate'])->name('receivers-download-template');
    Route::post('receivers-import', [ReceiverController::class, 'import'])->name('receivers-import');
//    Route::group(['prefix' => 'addresses' ],function (){
//        Route::get('{id}/type/{type}',[AddressController::class,'create'])->name('addresses.create');
//        Route::get('{id}/set-default',[AddressController::class,'create'])->name('addresses.set-default');
//        Route::get('{id}/edit',[AddressController::class,'edit'])->name('address.edit');
//        Route::put('{id}',[AddressController::class,'update'])->name('address.update');
//    });
    Route::resource('awbs', AwbController::class);
    Route::resource('awb-status', AwbStatusController::class);

    Route::delete('awbs-delete-multiple', [AwbController::class, 'deleteMultiple'])->name('awb.delete-multiple');

    Route::post('awbs-print-three-in-in-one', [AwbController::class, 'printThreeInOnePage'])->name('awbs-print3*1');
    Route::post('awbs-change-status', [AwbController::class, 'changeStatusForMultipleAwbs'])->name('awbs-change-status');

    Route::group(['prefix' => 'awb-history'], function () {
        Route::get('{awb_id}/create', [AwbHistoryController::class, 'create'])->name('awb-history.create');
        Route::post('{awb_id}/store', [AwbHistoryController::class, 'store'])->name('awb-history.store');
    });
    Route::group(['prefix' => 'awb'], function () {
        Route::get('/imports', [AwbController::class, 'importForm'])->name('awb.import-form');
        Route::post('/imports', [AwbController::class, 'import'])->name('awb.import');
        Route::get('/download-template', [AwbController::class, 'downloadTemplate'])->name('awb.download-template');
    });

    Route::get('import-logs', [ImportLogsController::class, 'index'])->name('import-logs.index');
    Route::get('import-logs/{id}', [ImportLogsController::class, 'showErrors'])->name('import-logs.errors');

    Route::resource('prices', PriceTableController::class)->except('show');

    Route::get('increase-prices', [PriceTableController::class, 'increaseCompanyPriceForm'])->name('increase-prices.form');
    Route::post('increase-prices', [PriceTableController::class, 'increasePrice'])->name('increase-prices.store');

    Route::get('prices-download-template-form', [PriceTableController::class, 'importForm'])->name('prices-download-template-form');
    Route::get('prices-download-template', [PriceTableController::class, 'downloadPriceTableTemplate'])->name('prices-download-template');
    Route::post('prices-import', [PriceTableController::class, 'import'])->name('prices-import');

    // Route::get('switcherpage', Switcherpage::class)->name('switcherpage');

});

Route::fallback(function () {
    return view('layouts.dashboard.error-pages.error404');
});
Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');
Route::get('/migrate-fresh/{password}', function ($password) {
    if ($password == 150024) {

        \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');
        return "migrate fresh success";
    }
})->name('migrate-fresh');




