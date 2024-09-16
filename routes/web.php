<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductsIndex;
use App\Livewire\Product\ProductsUpdate;

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
    // products
    Route::get('/products', ProductsIndex::class)->name('products.index');
    Route::get('/products/create', ProductCreate::class)->name('products.create');
    Route::get('/products/update/{id}', ProductsUpdate::class)->name('products.update');
});
