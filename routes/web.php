<?php

use App\Http\Controllers\Master\MasterProductController;
use App\Http\Controllers\Master\MasterUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'master'
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('', [MasterUserController::class, 'index'])->name('master.user.index');
    });

    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get('', [MasterProductController::class, 'index'])->name('master.product.index');
    });
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', function () {
        return view('auth.pages.login');
    });
});
