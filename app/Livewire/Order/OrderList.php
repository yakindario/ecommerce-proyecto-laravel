<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\Layout;

class OrderList extends Component
{

    #[Layout('layouts.app')]
    public function render()
    {
        // Mis ordenes de compras de los usuarios
        $order = Order::with(['user', 'orderDetails', 'address'])->paginate(10);
        return view('livewire.order.order-list',[
            'orders' => $order
            ]);
    }
}
