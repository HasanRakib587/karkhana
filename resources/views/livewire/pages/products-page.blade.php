<section class="products mt-5">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-md-12 my-5">
                <h1 class="font-primary fw-bolder">Product</h1>
            </div>
            <div class="filter d-flex justify-content-between">
                {{-- Category Sort --}}
                <ul class="list-unstyled px-3 d-flex">
                    @foreach ($categories as $category)
                        <li class="px-3 form-check" wire:key="{{ $category->id }}">
                            <label for="{{ $category->slug }}" class="form-check-label">
                                <input class="form-check-input" type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}"
                                    value="{{ $category->id }}" class="">
                                <span class="text-Dark">{{ $category->name }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
                <div class="">
                    <select class="form-select" wire:model.live="sort" class="">
                        <option value="latest">Sort by latest</option>
                        <option value="price">Sort by Price</option>
                    </select>
                </div>
            </div>

            <hr class="my-3" />

            <div class="row my-5" wire:key="product-list">
                @foreach ($products as $product)
                    <div class="col-lg-4" wire:key="{{ $product->id }}">
                        <div class="card-product card bg-dark text-white my-3">
                            <img src="{{ asset('uploads/' . $product->images[0]) }}" class="card-img" alt="{{ $product->name }}">
                            <div
                                class="card-img-overlay d-flex flex-column justify-content-end text-center bg-dark bg-opacity-50 p-3">
                                <a href="{{ route('product.detail', $product->slug) }}" wire:navigate>
                                    <h5 class="font-primary fw-bold card-title">{{ $product->name }}</h5>
                                </a>
                                <p class="font-secondary fw-bolder card-text">
                                    {{ Number::currency($product->price, 'BDT') }}
                                </p>
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="font-primary btn btn-outline-primary text-light">
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to
                                        Bag</span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Start -->
            <div class="d-flex justify-content-center my-5">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
            <!-- Pagination End -->
        </div>
    </div>
</section>