<?php

namespace App\Livewire\Pages;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart | KARKHANA')]
class CartPage extends Component
{
    public $cart_items = [];

    public $grand_total;

    public $discount = 0;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantity($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantity($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', count($this->cart_items));
    }

    public function render()
    {
        $this->discount = ($this->grand_total >= 7000) ? $this->grand_total * .07 : 0;

        return view('livewire.pages.cart-page', [
            'discount' => $this->discount,
        ]);
    }
}
