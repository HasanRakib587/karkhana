<section class="d-flex align-items-center bg-light py-5 my-5">

    @php
        $delivery_charge = trim(strtolower($order->address->location_type) == 'inside_dhaka') ? 80 : 180;
    @endphp

    <div class="container bg-white border rounded-3 p-4 p-md-5 shadow-sm">
        <h1 class="mb-4 fs-4 fw-semibold text-primary">
            Thank you. Your order has been received.
        </h1>

        <!-- Customer Info -->
        <div class="d-flex flex-column flex-md-row align-items-start border-bottom pb-4 mb-4">
            <div class="me-md-4">
                <div>
                    <p class="fs-5 fw-semibold mb-1 text-dark">{{ $order->address->full_name }}</p>
                    <p class="mb-0 text-muted small">{{ $order->address->street_address }}</p>
                    <p class="mb-0 text-muted small">{{ $order->address->district }}</p>
                    <p class="mb-0 text-muted small">{{ $order->address->zip_code }}</p>
                    <p class="mb-0 text-muted small">{{ $order->address->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="row border-bottom pb-4 mb-5">
            <div class="col-6 col-md-3 mb-3">
                <p class="text-muted small mb-1">Order Number:</p>
                <p class="fw-semibold text-dark mb-0">{{ $order->id }}</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <p class="text-muted small mb-1">Date:</p>
                <p class="fw-semibold text-dark mb-0">{{ $order->created_at->format('d-m-y') }}</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <p class="text-muted small mb-1">Total:</p>
                <p class="fw-semibold text-primary mb-0">{{ Number::currency($order->grand_total, 'BDT') }}</p>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <p class="small mb-1"><span class="fw-bold">Payment Method:</span>
                    {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Card' }}
                </p>

                {{-- @if ($order->payment_method == 'cod')
                <p class="fw-semibold text-dark mb-0">Cash on Delivery</p>
                @endif --}}
            </div>
        </div>

        <!-- Order Details & Shipping -->
        <div class="row g-4 mb-5">
            <!-- Order Details -->
            <div class="col-md-6">
                <h2 class="h5 fw-semibold text-primary mb-3">Order details</h2>
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0 text-dark">Subtotal</p>
                        <p class="mb-0 fw-bold">{{ Number::currency($order->grand_total, 'BDT') }}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0 text-dark">Discount</p>
                        <p class="mb-0 text-muted">0</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-dark">Delivery Charge</p>
                        <p class="mb-0 text-muted">{{ $delivery_charge }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-semibold text-dark mb-0">Total</p>
                    <p class="fw-semibold text-muted mb-0">
                        {{ Number::currency($order->grand_total + $delivery_charge, 'BDT') }}
                    </p>
                </div>
            </div>

            <!-- Shipping -->
            <div class="col-md-6">
                <h2 class="h5 fw-semibold text-primary mb-3">Shipping</h2>
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="text-primary" viewBox="0 0 16 16">
                                <path
                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 text-dark">
                                Delivery<br>
                                <span class="fw-normal small text-muted">Delivery within 24 Hours</span>
                            </p>
                        </div>
                    </div>
                    <p class="fw-semibold text-dark mb-0">{{ $delivery_charge }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-md-row gap-3">
            <a wire:navigate href="{{ route('products.all') }}"
                class="btn btn-lg btn-outline-primary w-100 w-md-auto text-dark">
                Go back shopping
            </a>
            <a wire:navigate href="{{ route('my.orders') }}" class="btn btn-lg btn-primary w-100 w-md-auto text-light">
                View My Orders
            </a>
        </div>
    </div>
</section>