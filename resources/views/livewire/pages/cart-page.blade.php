<div class="container py-5 my-5">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="h4 fw-semibold mb-4">Shopping Cart</h1>
    <div class="row g-4">
        <!-- Cart Table -->
        <div class="col-md-9">
            <div class="bg-white rounded shadow-sm p-4 mb-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart_items as $item)
                                <tr wire:key="{{ $item['product_id'] }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('uploads/' . $item["image"]) }}" alt="{{ $item['name'] }}"
                                                class="me-3 rounded" style="width: 70px; height: 70px; object-fit: cover;">
                                            <span class="fw-semibold">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ Number::currency($item['unit_amount'], 'BDT') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                                class="btn btn-primary text-light btn-sm me-2">−</button>
                                            <span class="text-center" style="width: 2rem;">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"
                                                class="btn btn-primary text-light btn-sm ms-2">+</button>
                                        </div>
                                    </td>
                                    <td>{{ Number::currency($item['total_amount'], 'BDT') }}</td>
                                    <td>
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="btn btn-outline-danger btn-sm">
                                            <span wire:loading.remove
                                                wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                                            <span wire:loading
                                                wire:target="removeItem({{ $item['product_id'] }})">Removing...</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <h1>No Items Available in Cart !</h1>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-md-3">
            <div class="bg-white rounded shadow-sm p-4">
                <h2 class="h6 fw-semibold mb-3">Summary</h2>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ Number::currency($grand_total, 'BDT') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    @if($discount > 0)
                        <span>Discount( 7% )</span>
                        <span>{{ Number::currency($grand_total * .07, 'BDT') }}</span>
                    @else
                        <span>Discount(0%)</span>
                        <span>{{ Number::currency($grand_total * 0, 'BDT') }}</span>
                    @endif
                </div>
                <hr class="my-3">
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-semibold">Total</span>
                    <span class="fw-semibold">{{ Number::currency($grand_total - $discount, 'BDT') }}</span>
                </div>
                @if ($cart_items)
                    <a wire:navigate href="{{ route('checkout') }}" class="btn btn-primary w-100 text-light">Checkout</a>
                @endif
            </div>
        </div>
    </div>
</div>