<x-form-section submit="updateProduct">
    <x-slot name="title">
        {{ __('Crear Producto') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Crear un nuevo producto con los detalles correspondientes.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre del Producto') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="product.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Descripción') }}" />
            <textarea id="description"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="product.description" required></textarea>
            <x-input-error for="description" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="price" value="{{ __('Precio') }}" />
            <x-input id="price" type="number" step="0.01" class="mt-1 block w-full" wire:model="product.price"
                required />
            <x-input-error for="price" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="image" value="{{ __('Imagen') }}" />
            <x-input id="image" type="file" class="mt-1 block w-full" wire:model="image" />
            <x-input-error for="image" class="mt-2" />
            @if (isset($product['image']))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product['image']) }}" alt="Imagen del Producto"
                        class="w-32 h-32 object-cover">
                </div>
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="category_id" value="Categoría" />
            <select id="category_id" wire:model="product.category_id"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">{{ __('Selecciona una categoría') }}</option>
                @foreach ($categories as $category)
                    <!-- La opción será seleccionada si el category_id coincide con el valor en $product['category_id'] -->
                    <option value="{{ $category->id }}"
                        {{ $category->id == $product['category_id'] ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error for="category_id" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved" color="text-green-500">
            {{ __('Producto creado correctamente.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
