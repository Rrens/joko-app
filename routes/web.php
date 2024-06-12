<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Master\MasterPlatformController;
use App\Http\Controllers\Master\MasterProductController;
use App\Http\Controllers\Master\MasterUserController;
use App\Http\Controllers\report\transactionController as ReportTransactionController;
use App\Http\Controllers\report\TransactionPerCategoryController;
use App\Http\Controllers\report\TransactionPerPlatformController;
use App\Http\Controllers\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

Route::redirect('cok', 'master/user');

Route::group([
    'prefix' => 'master',
    'middleware' => ['auth', 'role:admin,superadmin']
], function () {
    Route::group([
        'prefix' => 'user',
        'middleware' => ['auth', 'role:superadmin']
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
        Route::get('getPriceProduct/{productID}', [MasterProductController::class, 'getPriceProduct']);
    });

    Route::group([
        'prefix' => 'platform'
    ], function () {
        Route::get('', [MasterPlatformController::class, 'index'])->name('master.platform.index');
        Route::post('', [MasterPlatformController::class, 'store'])->name('master.platform.store');
        Route::post('update', [MasterPlatformController::class, 'update'])->name('master.platform.update');
        Route::post('delete', [MasterPlatformController::class, 'delete'])->name('master.platform.delete');
    });
});

Route::group([
    'prefix' => 'transaction',
    'middleware' => ['auth', 'role:admin,superadmin']
], function () {
    Route::get('', [TransactionController::class, 'input'])->name('transaction.index');
    Route::get('data', [TransactionController::class, 'data'])->name('transaction.data');
    Route::post('', [TransactionController::class, 'store'])->name('transaction.store');
    Route::post('update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::post('delete', [TransactionController::class, 'delete'])->name('transaction.delete');
});

Route::group([
    'prefix' => 'report',
    'middleware' => ['auth', 'role:superadmin']
], function () {
    Route::group([
        'prefix' => 'total-report'
    ], function () {
        Route::get('', [ReportTransactionController::class, 'index'])->name('report.total');
        Route::get('/{date}/{platform}/{category}', [ReportTransactionController::class, 'filter']);
    });

    Route::group([
        'prefix' => 'platform',
    ], function () {
        Route::get('', [TransactionPerPlatformController::class, 'index'])->name('report.platform');
        Route::get('/{month}/{year}', [TransactionPerPlatformController::class, 'filter']);
    });

    Route::group([
        'prefix' => 'category',
    ], function () {
        Route::get('', [TransactionPerCategoryController::class, 'index'])->name('report.category');
        Route::get('/{month}/{year}', [TransactionPerCategoryController::class, 'filter']);
    });
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('post-login', [LoginController::class, 'post_login'])->name('post-login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('check-stock/{productID}', [MasterProductController::class, 'check_stock']);
