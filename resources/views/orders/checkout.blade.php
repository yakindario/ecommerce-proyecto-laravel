@extends('layouts.order') <!-- Extiende del layout que mencionaste -->

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- El contenido de tu componente de checkout -->
            <div class="p-6">
                <div class="py-5 text-center">
                    <h2 class="text-2xl font-bold mb-2">Checkout</h2>
                    <p class="text-gray-600">Resumen de tu Orden</p>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/3 px-4 mb-4">
                        <h4 class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Producto:</span>
                            <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">3</span>
                        </h4>
                        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200 mb-3 sticky top-0">
                            @foreach ($cart as $item)
                                @php
                                    $product = \App\Models\Product::find($item['id']); // Encuentra el producto desde el ID
                                @endphp
                                <li class="flex justify-between items-center p-4">
                                    <div class="flex-1">
                                        <h6 class="text-sm font-medium text-gray-900 mb-1 flex items-center">
                                            <button wire:click="removeFromCart({{ $product->id }})"
                                                class="mr-2 text-red-500 hover:text-red-700 focus:outline-none">
                                                <!-- Botón para eliminar producto -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            {{ $product->name }}
                                        </h6>
                                        <small class="text-gray-500">{{ $product->description }}</small>
                                    </div>
                                    <span class="text-gray-600">${{ $product->price }}</span>
                                </li>
                            @endforeach
                            <li class="flex justify-between items-center p-4 font-semibold">
                                <span>Total (MXN)</span>
                                <strong>${{ number_format($totalPrice, 2) }}</strong> <!-- Usa la variable $totalPrice -->
                            </li>
                        </ul>
                        <div class="bg-gray-100 p-4 rounded-lg mt-4">
                            <button form="orderForm"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                type="submit">
                                Pago Mercado Pago
                            </button>
                        </div>
                    </div>
                    <div class="w-full md:w-2/3 px-4">
                        <h4 class="text-xl font-semibold mb-3">Billing address</h4>
                        <form class="needs-validation" id="orderForm" method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="flex flex-wrap -mx-2 mb-4">
                                <div class="w-full px-2 mb-4">
                                    <label for="fullName" class="block text-gray-700 mb-2">Full Name</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="full_name" id="fullName" value="{{ old('full_name', $user->name ?? '') }}"
                                        required>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-2 mb-4">
                                <div class="w-full px-2 mb-4">
                                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                                    <input type="email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                                        required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="block text-gray-700 mb-2">Address</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="address" id="address" value="{{ old('address', $address->address ?? '') }}"
                                    required>
                            </div>
                            <div class="flex flex-wrap -mx-2 mb-4">
                                <div class="w-full md:w-2/3 px-2 mb-4">
                                    <label for="state" class="block text-gray-700 mb-2">State</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        id="state" name="state" value="{{ old('state', $address->state ?? '') }}"
                                        required>
                                </div>
                                <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                                <div class="w-full md:w-1/3 px-2 mb-4">
                                    <label for="zip" class="block text-gray-700 mb-2">Zip</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        id="zip" name="zip" value="{{ old('zip', $address->zip ?? '') }}">
                                </div>
                            </div>
                            <hr class="my-6 border-t border-gray-300">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
