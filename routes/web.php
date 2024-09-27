<?php

use App\Http\Controllers\OrderController;
use App\Livewire\Order\MyOrder;
use App\Livewire\Order\OrderList;
use Illuminate\Support\Facades\Route;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductsIndex;
use App\Livewire\Product\ProductsUpdate;
use App\Models\Order;

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

    Route::get('/orders',[OrderController::class,'index'])->name('checkout');
    Route::resource('orders', OrderController::class)->only('store');
    Route::get('callback/{order:uuid}', [OrderController::class, 'callback'])->name('config');

    Route::get('/admin/orders',OrderList::class)->name('admin.orders');
    Route::get('/order',MyOrder::class)->name('myorder');
});
