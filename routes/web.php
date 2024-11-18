<?php

use App\Http\Livewire\Catalogo\CreateTicket; // Import the Livewire component class
use Illuminate\Support\Facades\Route;

// Routes that do not require authentication
Route::get('/', function () {
    return view('welcome');
});

// Routes that require authentication and verification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Route to the dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route to the branches page
    Route::get('/branch', function () {
        return view('brand');
    })->name('brand');

    // Route to the suppliers page
    Route::get('/supplier', function () {
        return view('supplier');
    })->name('supplier');

    // Route to the products page
    Route::get('/products', function () {
        return view('product');
    })->name('products');

    Route::get('/ticket', function () {
        return view('ticket');
    })->name('ticket');
});
