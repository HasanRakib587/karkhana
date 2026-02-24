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

<!--Carousel Slide Show -->
<section class="slide-show">
    <div class="row">
        <div class="carousel slide carousel-slide" data-bs-ride="carousel" id="carouselNavigation">
            <div class="carousel-inner">

                @foreach ($categories as $category)
                    <div class="carousel-item active" wire:key="{{ $category->id }}">
                        <img src="{{ asset('uploads/' . $category->image) }}" class="img-fluid w-100"
                            alt="{{ $category->name }}">
                        <div
                            class="d-none d-md-block carousel-caption d-flex flex-column align-items-center justify-content-center bg-primary bg-opacity-50 text-light mb-5 rounded-3">
                            <h2 class="font-primary fw-bold d-none d-md-block">{{ $category->name }}</h2>
                            <p class="font-secondary d-none d-md-block">
                                {{ $category->description }}
                            </p>
                            <a wire:navigate class="font-primary btn btn-lg btn-outline-primary text-light rounded-0"
                                href="/products?selected_categories[0]={{ $category->id }}">Shop
                                Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselNavigation"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselNavigation"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="container">
                <div class="row">
                    <div class="">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselNavigation" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselNavigation" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselNavigation" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-md-block d-md-none">
        <div class="col-sm-12 text-center my-5">
            <a wire:navigate class="font-primary btn btn-lg btn-primary text-light rounded-0" href="">Shop
                Now
            </a>
        </div>
    </div>
</section>