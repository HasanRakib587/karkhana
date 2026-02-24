<?php

namespace App\Livewire\Pages;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::where('customer_id', auth('customer')
            ->id())->latest()->paginate(6);

        return view('livewire.pages.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}
