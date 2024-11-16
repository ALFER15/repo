<?php

use App\Livewire\Catalogo\CreateCategory;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::get('/dashboard', function () {
         return view('dashboard');
     })->name('dashboard');

     Route::get('/brand', function () {
         return view('brand');
     })->name('brand');

     Route::get('/supplier', function () {
         return view('supplier');
     })->name('supplier');

     Route::get('/products', function () {
         return view('product');
     })->name('products');
    //Route::get('/dashboard', CreateCategory::class)->name('dashboard');
});

