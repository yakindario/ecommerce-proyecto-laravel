<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div wire:key="product-{{ $product->id }}"
                class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover" loading="lazy">
                </div>
                <div class="p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                    </div>
                    <div>
                        <div class="mb-4 flex justify-between items-center">
                            <span class="text-xs text-gray-500">Category: {{ $product->category->name }}</span>
                            <span
                                class="text-lg font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <button wire:click="addToCart({{ $product->id }})"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
