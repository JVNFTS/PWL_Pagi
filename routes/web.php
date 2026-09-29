<?php

use App\Models\Product;
//use App\Models\Supplier;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //return view('welcome');
    return Product::with('supplier')->get();
});
