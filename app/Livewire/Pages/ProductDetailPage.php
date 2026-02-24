<?php

namespace App\Livewire\Pages;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $slug;

    public $quantity = 1;

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id, $this->quantity);

        $this->dispatch('update-cart-count', $total_count);

        LivewireAlert::title('Thank You !')
            ->success()
            ->text('Your Item is Added to the Cart')
            ->position('top-start')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();
        $relatedProducts = Product::where('collection_id', $product->collection_id)
            ->where('id', '!=', $product->id)->get();

        return view('livewire.pages.product-detail-page', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'categories' => Category::query()->where('is_active', 1)->get(),
        ]);
    }
}
