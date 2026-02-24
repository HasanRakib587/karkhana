<?php

use App\Helpers\CartManagement;
use Livewire\Component;

new class extends Component {

    public $product_id;

    public function addToCart()
    {
        $total_count = CartManagement::addItemToCart($this->product_id);
        $this->dispatch('update-cart-count', $total_count);
        // LivewireAlert::title('Thank You !')
        //     ->text('Your Item is Added to the Cart')
        //     ->position('top-end')
        //     ->timer(3000)
        //     ->toast()
        //     ->show();
    }
};
?>

<button wire:click="addToCart" type="button" class="font-primary fw-bolder btn btn-light text-dark rounded-0 px-5 py-3">
    <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
    <span wire:loading wire:target="addToCart">Adding...</span>
    <i class="bi bi-cart me-1"></i>
</button>