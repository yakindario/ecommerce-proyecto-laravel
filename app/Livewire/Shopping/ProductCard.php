<?php

namespace App\Livewire\Shopping;

use Livewire\Volt\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;


class ProductCard extends Component
{
    use WithPagination;

    public function addToCart($productId)
    {
        // Añade un producto al carrito
        $product = Product::findOrFail($productId);
        $cart = session('cart', []);

        // Si el producto ya está en el carrito, incrementa la cantidad
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        Cache::put('cart', $cart, now()->addMinutes(30)); 
        // Cachea el carrito por 30 minutos
        $this->dispatch('cart-updated');
    }

    public function render(): mixed
    {
        $products = Product::with('category')->paginate(8);
        return view(
            'livewire.shopping.product-card',
            ['products' => $products]
        );
    }
}
