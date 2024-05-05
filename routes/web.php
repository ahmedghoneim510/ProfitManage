<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\ExpenditureDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfitsController;
use App\Http\Controllers\CustomerDetailsController;
use App\Http\Controllers\DashboardController;
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**************************************Customer****************************************************/
    Route::resource('customers', CustomerController::class);

    Route::resource('customers-details',CustomerDetailsController::class);
    /**************************************Expenditure****************************************************/
    Route::resource('expenditures', ExpenditureController::class);

    /**************************************ExpenditureDetail****************************************************/
    Route::resource('expenditure-details', ExpenditureDetailController::class)->except(['edit']);
    Route::get('expenditure-details-edit', [ExpenditureDetailController::class, 'edit'])->name('expenditure-details.edit');

    /*****************************************Users*************************************************/
    Route::resource('users', UserController::class);
    /******************************************************************************************/
    Route::resource('profits',ProfitsController::class);
    /******************************************************************************************/
    Route::get('/QrCode', [\App\Http\Controllers\GenerateqrcodeController::class, 'index'])->name('QrCode');

    /******************************************************************************************/

});


/*******************************************************************************************/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
