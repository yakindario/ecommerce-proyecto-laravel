<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class AddressUser extends Component
{
    public $state = [];

    public $hasAddress = false;

    public function mount()
    {
        $address = auth()->user()->address;
        if ($address) {
            $this->state = $address->toArray();
            $this->hasAddress = true;
        }
    }

    public function saveAddress()
    {
        // Validar los datos
        $this->validate([
            'state.address' => 'required|string|max:255',
            'state.city' => 'required|string|max:255',
            'state.state' => 'required|string|max:255',
            'state.zip' => 'required|string|max:10',
            'state.country' => 'required|string|max:255',
        ]);

        // Crear nueva dirección
        auth()->user()->address()->create($this->state);

        // Mostrar mensaje de éxito
        $this->dispatch('saved');
    }

    public function updateAddress()
    {
        // Validar los datos
        $this->validate([
            'state.address' => 'required|string|max:255',
            'state.city' => 'required|string|max:255',
            'state.state' => 'required|string|max:255',
            'state.zip' => 'required|string|max:10',
            'state.country' => 'required|string|max:255',
        ]);

        // Actualizar dirección existente
        auth()->user()->address()->update($this->state);

        // Mostrar mensaje de éxito
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.profile.address-user');
    }
}
