<?php

namespace App\Livewire\Pages;

use App\Helpers\CartManagement;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $phone;

    public $zip_code;

    public $first_name;

    public $last_name;

    public $bkash_trx_id;

    public $street_address;

    public $payment_method;

    public $bkash_last_digits;

    public $location_type;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();

        if (count($cart_items) == 0) {
            return redirect(route('products.all'));
        }
    }

    public function placeOrder()
    {
        // 1️⃣ Validate
        $validated = $this->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'location_type' => 'required|in:inside_dhaka,outside_dhaka',

            'bkash_last_digits' => 'nullable|required_if:location_type,outside_dhaka|digits:3',
            'bkash_trx_id' => 'nullable|string|max:50',
        ]);

        // 2️⃣ Get Cart
        $cart_items = CartManagement::getCartItemsFromCookie();

        if (empty($cart_items)) {
            session()->flash('error', 'Your cart is empty.');

            return redirect()->back();
        }

        DB::beginTransaction();

        try {

            // 3️⃣ Calculate Shipping
            $shippingCost = $validated['location_type'] === 'inside_dhaka' ? 60 : 120;

            $grandTotal = CartManagement::calculateGrandTotal($cart_items) + $shippingCost;

            // 4️⃣ Create Order
            $order = Order::create([
                'customer_id' => auth('customer')->id(),
                'transaction_reference' => 'TXN_'.strtoupper(uniqid()),
                'grand_total' => $grandTotal,
                'shipping_cost' => $shippingCost,
                'payment_status' => 'pending',
                'status' => 'new',
                'notes' => 'Order placed by '.auth('customer')->user()->name,
                'payment_method' => $validated['location_type'] === 'outside_dhaka' ? 'bkash' : 'COD',
                'bkash_last_digits' => $validated['bkash_last_digits'] ?? null,
                'bkash_trx_id' => $validated['bkash_trx_id'] ?? null,
            ]);

            // 5️⃣ Save Order Address
            $order->address()->create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'street_address' => $validated['street_address'],
                'location_type' => $validated['location_type'],
            ]);

            // 6️⃣ Save Order Items
            $order->items()->createMany(
                array_map(fn ($item) => [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['unit_amount'] * $item['quantity'],
                ], $cart_items)
            );

            // 7️⃣ Clear Cart
            CartManagement::clearCart();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            \Log::error('Order creation failed: '.$e->getMessage());

            session()->flash('error', 'Something went wrong. Please try again.');

            return redirect()->back();
        }

        // 8️⃣ Send Email (Outside transaction)
        try {
            Mail::to($order->customer->email)
                ->send(new OrderConfirmation($order));
        } catch (\Throwable $e) {
            \Log::error('Order email failed: '.$e->getMessage());
        }

        // 9️⃣ Success
        session()->flash('order_success', true);

        return redirect()->route('success');
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        $deliveryCharge = ($this->location_type === 'inside_dhaka') ? 80.0 : 180.0;

        return view('livewire.pages.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
            'deliveryCharge' => $deliveryCharge,
        ]);
    }
}
