<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InventoryStockController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('report', [DashboardController::class, 'report'])->name('reports.index');

    // Sales
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('sales-money', [SaleController::class, 'salesMoney'])->name('sales.money');
    Route::get('sales-history', [SaleController::class, 'salesHistory'])->name('sales.history');
    Route::get('sales-history-product-details/{id}', [SaleController::class, 'salesHistoryProductDetails'])->name('sales.history.product-details');
    Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
    Route::post('sales-money', [SaleController::class, 'storeMoney'])->name('sales.store-money');
    Route::delete('sales-money-delete/{id}', [SaleController::class, 'deleteMutation'])->name('sales.delete-money');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('users', UserController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::resource('debts', DebtController::class);
    Route::get('inventories', [InventoryStockController::class, 'index'])->name('inventories.index');
});
