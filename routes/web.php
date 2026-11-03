<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'productCount'     => Product::count(),
        'supplierCount'    => Supplier::count(),
        'transactionCount' => Transaction::count(),
        'latest'           => Transaction::with('supplier')->latest()->take(5)->get(),
    ]);
})->name('home');

Route::resource('products', ProductController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('transactions', TransactionController::class)->except(['edit', 'update']);