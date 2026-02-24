<?php

namespace App\Livewire\Pages;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_collection = [];

    #[Url]
    public $sort = 'latest';

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', $total_count);
        // LivewireAlert::title('Thank You !')
        //     ->text('Your Item is Added to the Cart')
        //     ->position('top-end')
        //     ->timer(3000)
        //     ->toast()
        //     ->show();
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        if (! empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (! empty($this->selected_collection)) {
            $productQuery->whereIn('collection_id', $this->selected_collection);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.pages.products-page', [
            'products' => $productQuery->paginate(9),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
