<div class="container py-5 mt-5">
    @if ($errors->any())
        <pre>{{ print_r($errors->all(), true) }}</pre>
    @endif
    <h1 class="h3 fw-bold mb-4">Checkout</h1>
    <form wire:submit.prevent="placeOrder">
        <div class="row g-4">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Shipping Address -->
                        <h2 class="h5 fw-bold text-decoration-underline mb-3">
                            Shipping Address
                        </h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input wire:model="first_name" type="text" class="form-control @error('first_name')
                                    border-danger
                                @enderror" id="first_name" />
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input wire:model="last_name" type="text" class="form-control @error('last_name')
                                    border-danger
                                @enderror" id="last_name" />
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input wire:model="phone" type="text" class="form-control @error('phone')
                                    border-danger
                                @enderror" id="phone" />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Street Address</label>
                                <input wire:model="street_address" type="text" class="form-control @error('street_address')
                                    border-danger
                                @enderror" id="address" />
                                @error('street_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="zip" class="form-label">ZIP Code</label>
                                <input wire:model="zip_code" type="text" class="form-control @error('zip_code')
                                    border-danger
                                @enderror" id="zip" />
                                @error('zip_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- District --}}
                            <div class="col-12">
                                <label for="district" class="form-label">District</label>
                                <select wire:model.live="district" id="district"
                                    class="form-control @error('district') border-danger @enderror">
                                    <option value="">-- Select District --</option>
                                    <option value="insidedhaka">Inside Dhaka</option>
                                    <option value="outsidedhaka">Outside Dhaka</option>
                                </select>
                                @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($district !== 'insidedhaka')
                                    <div class="mt-4 alert alert-warning">
                                        <div class="card shadow-sm border-2">
                                            <div class="card-body">
                                                <h5 class="fw-bold text-danger mb-3">Pay with bKash</h5>

                                                <div class="row align-items-center">
                                                    <div class="col-md-7 mb-3 mb-md-0">
                                                        <p class="mb-2">Send money to the following bKash number:</p>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <span class="badge bg-danger me-2">bKash</span>
                                                            <span class="fs-5 fw-bold">01779843134</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5 text-center">
                                                        <img src="{{ asset('images/karkhana-bkash.jpeg') }}" width="160" />
                                                    </div>
                                                </div>

                                                <hr class="my-4" />

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">
                                                            Last 3 digits of your bKash number
                                                        </label>
                                                        <input type="text" wire:model.defer="bkash_last_digits"
                                                            maxlength="3"
                                                            class="form-control @error('bkash_last_digits') border-danger @enderror" />
                                                        @error('bkash_last_digits')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">
                                                            Transaction ID (optional)
                                                        </label>
                                                        <input type="text" wire:model.defer="bkash_trx_id"
                                                            class="form-control" />
                                                    </div>
                                                </div>

                                                <p class="small text-muted mt-3">
                                                    Payment verification may take up to 1–2 hours.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-decoration-underline mb-3">
                            ORDER SUMMARY
                        </h5>
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Subtotal</span><span>{{ Number::currency($grand_total, 'BDT') }}</span>
                        </div>
                        {{-- <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Vat(15%)</span><span>{{ Number::currency($grand_total * .15, 'BDT') }}</span>
                        </div> --}}
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Delivery Charge</span><span>{{ Number::currency($deliveryCharge, 'BDT') }}</span>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Grand
                                Total</span><span>{{ Number::currency($grand_total + $deliveryCharge, 'BDT') }}</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mb-4">
                    <span wire:loading.removed>Place Order</span>
                    <span wire:loading>Processing...</span>
                </button>

                <!-- Basket Summary -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-decoration-underline mb-3">
                            BASKET SUMMARY
                        </h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($cart_items as $cart_item)
                                <li class="list-group-item d-flex align-items-center border-2"
                                    wire:key="{{ $cart_item['product_id'] }}">
                                    <img src="{{ asset('uploads/' . $cart_item['image']) }}" alt="{{ $cart_item['name'] }}"
                                        class="rounded me-3" width="50" />
                                    <div class="flex-fill">
                                        <div class="fw-semibold">{{ $cart_item['name'] }}</div>
                                        <small class="text-muted">Quantity: {{ $cart_item['quantity'] }}</small>
                                    </div>
                                    <div class="fw-bold">{{ Number::currency($cart_item['total_amount'], 'BDT') }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>