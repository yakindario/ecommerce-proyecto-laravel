<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <!-- Muestra la cantidad total de artículos en el carrito -->
        <span class="font-semibold"></span>
        <span
            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-5 w-5 flex items-center justify-center text-xs">
            {{ $itemCount }}
        </span>
    </button>

    <!-- Desplegable del carrito -->
    <div x-show="open" @click.away="open = false"
        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">Total:</h3>
            @if (count($cart) > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach ($cart as $item)
                        <li class="py-2 flex justify-between items-center" wire:key="cart-item-{{ $item['id'] }}">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $item['quantity'] }} x
                                    ${{ number_format($item['price'], 2) }}</p>
                            </div>
                            <!-- Botón para eliminar artículo -->
                            <button wire:click="removeFromCart({{ $item['id'] }})"
                                class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </li>
                    @endforeach
                </ul>

                <!-- Total del carrito -->
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-lg font-semibold">Total:</span>
                    <span class="text-lg font-bold">${{ number_format($total, 2) }}</span>
                </div>

                <!-- Botón para ver el carrito completo -->
                <button wire:click="proceedToCheckout"
                    class="mt-4 block w-full bg-indigo-600 text-white text-center py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-300 ease-in-out">
                    Pagar
                </button>
            @else
                <p class="text-gray-500">Your cart is empty.</p>
            @endif
        </div>
    </div>
</div>
