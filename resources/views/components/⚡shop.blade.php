<?php

use App\Models\Category;
use Livewire\Component;

new class extends Component {
    public $categories;

    public function mount()
    {
        $this->categories = Category::where('is_active', 1)->get();
    }
};
?>

<!-- Shop Section -->
<section class="shop my-5">
    <div class="container py-5">
        <div class="row">
            <!-- Shop Section Title -->
            <div class="shop-heading">
                <h1 class="font-primary fw-bolder display-4">Shop</h1>
                <hr>
            </div>
            @foreach ($categories as $category)
                @php
                    $isEven = $loop->iteration % 2 === 0;
                @endphp
                <!-- Card 1 -->
                <div class="col-6 col-md-4 col-lg-12 mt-5" wire:key="shop-{{ $category->id }}">
                    <div class="card flex-column flex-lg-row align-items-center bg-secondary border-0">
                        <div class="col-lg-6 {{ $isEven ? 'order-lg-2' : 'order-lg-1' }}">
                            <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}">
                                <img src="{{ asset('uploads/' . $category->image) }}" class="img-fluid w-100 card-cat-image"
                                    alt="{{ $category->name }}" />
                            </a>
                        </div>
                        <div class="card-body col-lg-6 order-lg-1">
                            <h2 class="font-primary fw-bolder card-title d-none d-lg-block text-dark">{{ $category->name }}
                            </h2>
                            <div class="card-text d-none d-lg-block">
                                <p class="font-secondary fw-light text-dark">
                                    {{ $category->description }}
                                </p>
                                <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}"
                                    class="font-primary fw-bolder btn btn-lg btn-primary text-light px-5 rounded-0">Shop</a>
                            </div>
                            <div class="d-grid d-md-none">
                                <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}"
                                    class="font-primary fw-light btn btn-outline-primary text-dark">{{ $category->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>