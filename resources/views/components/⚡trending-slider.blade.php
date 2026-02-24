<?php

use App\Models\Product;
use Livewire\Component;

new class extends Component {
    public $featuredProducts;
    public function mount()
    {
        $this->featuredProducts = Product::where('is_active', 1)->get();
    }
};
?>

<!-- Trending [Horizontal Cards] Swiper Slide Show -->
<section class="horizontal-cards my-5">
    <div class="container">
        <div class="row">
            <div class="container text-center py-3 text-dark">
                <h2 class="font-primary fw-bolder display-6">Trending</h2>
            </div>
        </div>

        <!-- Swiper Container -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($featuredProducts as $featuredProduct)
                    <!-- Slide 1 -->
                    <div class="swiper-slide" wire:key="fetured-{{ $featuredProduct->id }}">
                        <div class="card trending-card bg-primary text-light border-primary">
                            <div class="row g-0">
                                <div class="col-6 col-md-5 order-1">
                                    <img src="{{ asset('uploads/' . $featuredProduct->images[1]) }}"
                                        class="card-img img-fluid rounded-start" alt="Pendant" />
                                </div>
                                <div class="col-6 col-md-7">
                                    <div class="card-body d-flex flex-column">
                                        <div class="h-100">
                                            <h3 class="font-secondary fw-light card-title text-light">
                                                {{ $featuredProduct->category->name }}
                                            </h3>
                                            <a href="{{ route('product.detail', $featuredProduct->slug) }}"
                                                class="text-light text-decoration-none">
                                                <h2 class="font-primary fw-bolder card-title">
                                                    {{ $featuredProduct->name }}
                                            </a>
                                            </h2>
                                            <p class="font-secondary fw-light card-text">
                                                {{ $featuredProduct->description }}
                                            </p>
                                            <h4 class="card-title mb-3">
                                                ৳<strong class="font-secondary mx-1">{{ $featuredProduct->price}}</strong>
                                                </strong>
                                            </h4>
                                            <div>
                                                <livewire:add-to-cart-button :product_id="$featuredProduct->id" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="d-flex justify-content-center align-items-center gap-4 position-relative">
                    <div class="swiper-button-wrapper">
                        <button class="swiper-prev btn mx-2 text-primary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-button-wrapper">
                        <button class="swiper-next btn mx-2 text-primary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                class="flip-horizontal">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </button>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="container">
                    <div class="d-flex justify-content-center py-3">
                        <button class="btn mx-2 swiper-prev text-primary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </button>
                        <button class="btn text-primary mx-2" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                class="flip-horizontal swiper-next">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>