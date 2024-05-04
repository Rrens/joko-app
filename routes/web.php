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

Route::redirect('cok', 'master/user');

Route::group([
    'prefix' => 'master'
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('', [MasterUserController::class, 'index'])->name('master.user.index');
        Route::post('', [MasterUserController::class, 'store'])->name('master.user.store');
        Route::post('update', [MasterUserController::class, 'update'])->name('master.user.update');
        Route::post('delete', [MasterUserController::class, 'delete'])->name('master.user.delete');
    });

    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get('', [MasterProductController::class, 'index'])->name('master.product.index');
        Route::post('', [MasterProductController::class, 'store'])->name('master.product.store');
        Route::post('update', [MasterProductController::class, 'update'])->name('master.product.update');
        Route::post('delete', [MasterProductController::class, 'delete'])->name('master.product.delete');
    });
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', function () {
        return view('auth.pages.login');
    });
});
