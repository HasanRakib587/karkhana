<div class="container py-5 px-4 mt-5">
    @php
        use App\Helpers\HelperUtility;
    @endphp
    <h1 class="h2 fw-bold text-primary mb-4">My Orders</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-uppercase text-dark small fw-semibold">Order</th>
                            <th scope="col" class="text-uppercase text-dark small fw-semibold">Date</th>
                            <th scope="col" class="text-uppercase text-dark small fw-semibold">Order Status</th>
                            <th scope="col" class="text-uppercase text-dark small fw-semibold">Payment Status</th>
                            <th scope="col" class="text-uppercase text-dark small fw-semibold">Order Amount</th>
                            <th scope="col" class="text-end text-uppercase text-dark small fw-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr wire:key="{{ $order->id }}">
                                <td class="fw-medium text-dark">{{ $order->id }}</td>
                                <td class="text-dark">{{ $order->created_at->format('d-m-y') }}</td>
                                <td>
                                    <span
                                        class="badge {{ HelperUtility::getBadge($order->status) }} text-white shadow-sm px-3 py-2">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td><span
                                        class="badge {{ HelperUtility::getBadge($order->payment_status) }} text-white shadow-sm px-3 py-2">
                                        {{ strtoupper($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-dark">{{ Number::currency($order->grand_total, 'BDT') }}</td>
                                <td class="text-end">
                                    <a wire:navigate href="{{ route('order.details', $order->id) }}"
                                        class="btn btn-sm btn-primary text-light shadow-sm">View
                                        Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>