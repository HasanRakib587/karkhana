<section class="product-info my-5 py-5">
    <!-- Single Product Info -->
    <div class="container">
        <div class="row" wire:ignore>

            <div class="col-md-6 d-flex flex-column justify-content-center">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" wire:ignore>
                    <div class="carousel-inner">
                        @foreach ($product->images as $img)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                                wire:key="image-{{ $product->id }}">
                                <div x-data="{ scale: 1, originX: '50%', originY: '50%' }"
                                    @mousemove="scale = 2.5; originX = ($event.offsetX / $event.target.clientWidth) * 100 + '%'; originY = ($event.offsetY / $event.target.clientHeight) * 100 + '%'"
                                    @mouseleave="scale = 1" class="zoom-container">
                                    <img src="{{ asset('uploads/' . $img) }}" class="d-block img-fluid"
                                        :style="`transform: scale(${scale}); transform-origin: ${originX} ${originY}; transition: transform 0.4s ease;`"
                                        alt="{{ $product->name }}" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3">
                    <div class="d-flex justify-content-evenly align-items-center">

                        {{-- Previous Slide Button --}}
                        <a type="button" href="#" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </a>

                        {{-- Slide Thumbnails --}}
                        <ul class="list-unstyled d-flex align-items-center">
                            @foreach ($product->images as $index => $img)
                                <li class="px-2" wire:key="thumb-{{ $product->id }}">
                                    <a href="" data-bs-target="#carouselExampleSlidesOnly"
                                        data-bs-slide-to="{{ $index }}"><img class="img-fluid"
                                            src="{{ asset('uploads/' . $img) }}" alt="" width="64px" height="64px" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Next Slide Button --}}
                        <a href="" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                                class="flip-horizontal">
                                <path fill="none" stroke="currentColor"
                                    d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                    stroke-width="1" />
                            </svg>
                        </a>
                    </div>

                    {{-- <div class="d-flex mt-3">
                        <h5 class="font-secondary fw-light px-2 text-center">
                            Free Shipping on order $75+
                        </h5>
                        <div class="vr"></div>
                        <h5 class="font-secondary fw-light px-2 text-center">
                            Free Extended return 1/30
                        </h5>
                        <div class="vr"></div>
                        <h5 class="font-secondary fw-light px-2 text-center">
                            Ship to Home, Delivered in 2-4 business days
                        </h5>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-6">
                <h1 class="font-primary text-dark">
                    {{ $product->name }}
                </h1>
                <h5 class="font-primary text-dark fw-bold">
                    {{ Number::currency($product->price, 'BDT') }}
                </h5>
                <p class="font-secondary lead text-dark">
                    {{ $product->description }}
                </p>


                <hr>
                <h4>Quantity</h4>
                <div class="d-flex align-items-center mt-4" style="max-width: 150px;"
                    wire:key="qty-controls-{{ $product->id }}">
                    <button wire:click="decreaseQty" type="button" class="btn btn-outline-primary rounded-start">
                        <span class="fs-6 fw-light">−</span>
                    </button>
                    <input type="text" wire:model.live="quantity"
                        class="form-control text-center fw-semibold border-none rounded-0 bg-secondary text-dark"
                        readonly>
                    <button wire:click="increaseQty" type="button" class="btn btn-outline-primary rounded-end ">
                        <span class="fs-6 fw-light">+</span>
                    </button>
                </div>

                <div class="button-container d-grid mt-1">
                    <button wire:click="addToCart({{ $product->id }})" type="button"
                        class="my-5 font-primary fw-bold btn btn-lg btn-primary text-light rounded-0 p-2">
                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to Bag</span>
                        <span wire:loading wire:target="addToCart({{ $product->id }})">Adding..</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- You May Also Like -->
    <section class="also-like my-5">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h1 class="font-primary fw-bold">You May Also Like</h1>
                    <a type="button" class="px-3 swiper-next" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                            class="flip-horizontal">
                            <path fill="none" stroke="currentColor"
                                d="M8 5c0 .742-.733 1.85-1.475 2.78c-.954 1.2-2.094 2.247-3.401 3.046C2.144 11.425.956 12 0 12m0 0c.956 0 2.145.575 3.124 1.174c1.307.8 2.447 1.847 3.401 3.045C7.267 17.15 8 18.26 8 19m-8-7h24"
                                stroke-width="1" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach ($relatedProducts as $products)
                    <div class="col-md-3">
                        <div class="card-product card bg-primary text-light my-3">
                            <img src="{{ asset('uploads/' . $products->images[0]) }}" class="card-img"
                                alt="{{ $products->name }}" />
                            <div
                                class="card-img-overlay d-flex flex-column justify-content-end text-center bg-dark bg-opacity-50 p-3">
                                <a wire:navigate href="{{ route('product.detail', $products->slug) }}"
                                    class="text-light text-decoration-none">
                                    <h5 class="font-primary fw-bold card-title">{{ $products->name }}</h5>
                                </a>
                                <p class="font-primary card-text">
                                    {{ Number::currency($products->price, 'BDT') }}
                                </p>
                                <button class="font-primary btn btn-outline-primary text-light">
                                    Add to Bag
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Shop Section -->
    <livewire:shop />

    <livewire:footer />

    @push('scripts')
        <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    @endpush
</section>