<div class="container py-5 px-4">
    <h1 class="h2 fw-bold text-secondary mb-4">Order Details</h1>
    @php
        use App\Helpers\HelperUtility;
    @endphp
    <!-- Grid -->
    <div class="row g-4">
        <a wire:navigate class="btn btn-primary" href="{{ route('my.orders') }}">Back</a>
        <!-- Customer Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border rounded-3 h-100">
                <div class="card-body d-flex gap-3 align-items-start">
                    <div class="d-flex justify-content-center align-items-center bg-light rounded p-3"
                        style="width:64px; height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-uppercase small text-muted mb-1">Customer</p>
                        <div class="fw-semibold">{{ $order->address->first_name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Date Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border rounded-3 h-100">
                <div class="card-body d-flex gap-3 align-items-start">
                    <div class="d-flex justify-content-center align-items-center bg-light rounded p-3"
                        style="width:64px; height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                            <path d="M5 22h14" />
                            <path d="M5 2h14" />
                            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-uppercase small text-muted mb-1">Order Date</p>
                        <h5 class="fw-semibold text-dark mb-0">{{ $order->items[0]->created_at->format('d-m-y') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border rounded-3 h-100">
                <div class="card-body d-flex gap-3 align-items-start">
                    <div class="d-flex justify-content-center align-items-center bg-light rounded p-3"
                        style="width:64px; height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-uppercase small text-muted mb-1">Order Status</p>
                        <span
                            class="badge {{ HelperUtility::getBadge($order->status) }} text-white px-3 py-2 shadow-sm">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border rounded-3 h-100">
                <div class="card-body d-flex gap-3 align-items-start">
                    <div class="d-flex justify-content-center align-items-center bg-light rounded p-3"
                        style="width:64px; height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-uppercase small text-muted mb-1">Payment Status</p>
                        <span
                            class="badge {{ HelperUtility::getBadge($order->status) }} text-white px-3 py-2 shadow-sm">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Grid -->

    <!-- Two-column layout -->
    <div class="row mt-4 g-4">
        <!-- Left Side -->
        <div class="col-12 col-md-8">
            <!-- Products Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr wire:key="{{ $item->id }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/' . $item->product->images[0]) }}"
                                                    alt="{{ $item->product->name }}" class="me-3 rounded"
                                                    style="width:64px; height:64px;">
                                                <span class="fw-semibold">{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ Number::currency($item->unit_amount, 'BDT') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ Number::currency($item->total_amount, 'BDT') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-3">Shipping Address</h4>
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <p class="mb-0">
                            {{ $order->address->street_address }},
                            {{-- {{ $$order->address->location_type }}, --}}
                            {{ $order->address->zip_code }}
                        </p>
                        <div>
                            <p class="fw-semibold mb-1">Phone:</p>
                            <p class="mb-0">{{ $order->address->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Summary -->
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($order->grand_total, 'BDT') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Vat(15%)</span>
                        <span>{{ Number::currency($order->grand_total * .15, 'BDT') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>{{ Number::currency(60, 'BDT') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-semibold">
                        <span>Grand Total</span>
                        <span>
                            {{ Number::currency($order->grand_total + $order->grand_total * .15 + 60, 'BDT') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>