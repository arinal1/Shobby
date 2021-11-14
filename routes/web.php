<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreOrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('preorder/{id}', [PreOrderController::class, 'showPreOrder']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:owner,backoffice'], function () {
        Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name("dashboard");

        Route::get('dashboard/product/detail/{id?}', [DashboardController::class, 'showProductDetail'])->name('product.detail');
        Route::post('dashboard/product/detail', [DashboardController::class, 'saveProductDetail'])->name('product.save');
        Route::post('dashboard/product/delete', [DashboardController::class, 'deleteProduct'])->name('product.delete');

        Route::get('dashboard/transaction/detail/{id?}', [DashboardController::class, 'showTransactionDetail'])->name('transaction.detail');
        Route::post('dashboard/transaction/detail', [DashboardController::class, 'saveTransactionDetail'])->name('transaction.save');
        Route::post('dashboard/transaction/delete', [DashboardController::class, 'deleteTransaction'])->name('transaction.delete');
    });

    Route::group(['middleware' => 'role:owner'], function () {
        Route::get('dashboard/user/detail/{id?}', [DashboardController::class, 'showUserDetail'])->name('user.detail');
        Route::post('dashboard/user/detail', [DashboardController::class, 'saveUserDetail'])->name('user.save');
        Route::post('dashboard/user/delete', [DashboardController::class, 'deleteUser'])->name('user.delete');
    });

    Route::group(['middleware' => 'role:user'], function () {
        Route::get('transactions', [PreOrderController::class, 'showPreOrderList'])->name('transactions');
        Route::post('preorder/checkout', [PreOrderController::class, 'checkoutPreOrder'])->name('preorder.checkout');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name("logout");
});
