<?php

namespace App\Livewire\Shopping;

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Cache;

class ShoppingCart extends Component
{
    public $cart = [];

    public $itemCount = 0;

    public $totalPrice = 0.0;

    //  Escucha el evento 'cart-updated' y llama al método updateCartFromSession
    protected $listeners = ['cart-updated' => 'updateCartFromSession'];

    public function mount()
    {
        // Actualiza el carrito desde la sesión
        $this->updateCartFromSession();
    }

    public function updateCartFromSession()
    {
        // Actualiza el carrito desde la sesión
        $this->cart = Cache::get('cart', session('cart', []));
        // Usa cache primero, si no está disponible, usa la sesión 
        $this->calculateTotals();
    }

    public function removeFromCart($productId)
    {
        // Elimina un producto del carrito
        $cart = Cache::get('cart', session('cart', []));
        unset($cart[$productId]);

        // Actualiza la sesión y el cache del carrito
        session(['cart' => $cart]);
        Cache::put('cart', $cart, now()->addMinutes(30)); // Actualiza el cache del carrito

        // Actualiza el carrito y los totales
        $this->updateCartFromSession();
        $this->dispatch('cart-updated');
    }

    public function calculateTotals()
    {
        // Calcula el total de productos y el precio total
        $this->itemCount = array_sum(array_column($this->cart, 'quantity'));
        $this->totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cart));
    }
    public function proceedToCheckout()
    {
        // dd('Proceder al checkout');
        // Guardar la información del carrito y el total en la sesión
        session([
            'cart' => $this->cart,
            'total' => $this->totalPrice,  // Asegurar que la clave es 'total'
            'item_count' => $this->itemCount,
        ]);

        // Redirigir al controlador del checkout
        return redirect()->route('checkout');
    }

    public function render():mixed
    {
        return view('livewire.shopping.shopping-cart',
        ['cart' => $this->cart,
        'total' => $this->totalPrice,]);
    }
}
