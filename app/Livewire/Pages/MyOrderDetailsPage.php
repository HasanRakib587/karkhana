<?php

namespace App\Livewire\Pages;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Details | KARKHANA')]
class MyOrderDetailsPage extends Component
{
    public $order_id;

    public $order;

    public function mount($order_id)
    {
        $this->order_id = $order_id;

        $this->order = Order::with([
            'items.product',
            'address',
            'customer',
        ])
            ->where('id', $order_id)
            ->where('customer_id', auth('customer')->id()) // security check
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.my-order-details-page', [
            'order' => $this->order,
        ]);
    }
}
