<x-form-section submit="{{ $hasAddress ? 'updateAddress' : 'saveAddress' }}">
    <x-slot name="title">
        {{ $hasAddress ? __('Actualizar Dirección') : __('Crear Dirección') }}
    </x-slot>

    <x-slot name="description">
        {{ $hasAddress ? __('Actualiza tu dirección de envío.') : __('Ingresa tu nueva dirección de envío.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Dirección') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" required />
            <x-input-error for="address" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="city" value="{{ __('Ciudad') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" required />
            <x-input-error for="city" class="mt-2" />
        </div>

        <!-- State -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="state" value="{{ __('Estado') }}" />
            <x-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state.state" required />
            <x-input-error for="state" class="mt-2" />
        </div>

        <!-- ZIP -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="postal_code" value="{{ __('Código Postal') }}" />
            <x-input id="postal_code" type="text" class="mt-1 block w-full" wire:model.defer="state.zip" required />
            <x-input-error for="postal_code" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="country" value="{{ __('País') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="state.country"
                required />
            <x-input-error for="country" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ $hasAddress ? __('Actualizar') : __('Guardar') }}
        </x-button>
    </x-slot>
    <x-slot name="actions">
        <x-action-message class="me-3" on="saved" color="text-green-500">
            {{ $hasAddress ? __('Dirección actualizada.') : __('Dirección creada') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
