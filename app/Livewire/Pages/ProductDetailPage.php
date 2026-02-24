<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
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
