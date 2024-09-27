<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class MyOrder extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render()
    {
        // Mis ordenes de compras de los usuario autenticado
        $order = Order::with(['user', 'orderDetails','address'])
        ->where('user_id', auth()->id()
        )->latest()->paginate(5);
        return view('livewire.order.my-order',
        [
            'orders' => $order
        ]);
    }
}
