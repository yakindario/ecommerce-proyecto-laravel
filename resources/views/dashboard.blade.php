<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!Auth::check())
                <div class="mb-5 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">¡Atención!</p>
                    <p>Para comprar, primero debes iniciar sesión.</p>
                </div>
            @endif
            @livewire('shopping.product-card')

        </div>
    </div>
</x-app-layout>
