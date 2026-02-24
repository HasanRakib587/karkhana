<?php

namespace App\Livewire\Pages;

use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SuccessPage extends Component
{
    public function mount()
    {
        // Check if user came from checkout or payment success
        if (! Session::pull('order_success', false)) {
            // If not set, block access
            abort(403, 'Unauthorized access to success page.');
        }
    }

    public function render()
    {
        $latest_order = Order::with('address')
            ->where('customer_id', auth('customer')->user()->id)->latest()->first();

        return view('livewire.pages.success-page', [
            'order' => $latest_order,
        ]);
    }
}
