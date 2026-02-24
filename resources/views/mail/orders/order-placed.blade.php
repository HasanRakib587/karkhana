@php
    $delivery_charge = trim(strtolower($order->address->district)) == 'insidedhaka' ? 80 : 150;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Invoice - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .header {
            background: #AE9375;
            color: white;
            text-align: center;
            padding: 25px 10px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        .body {
            padding: 30px;
        }

        h2 {
            font-size: 16px;
            color: #CFAA8A;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
        }

        .info {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #f1f3f5;
        }

        table th,
        table td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        table th {
            font-weight: 600;
            color: #555;
        }

        .total {
            text-align: right;
            padding-top: 10px;
            font-size: 15px;
        }

        .total strong {
            color: #CFAA8A;
        }

        .footer {
            text-align: center;
            background: #f8f9fa;
            padding: 15px;
            font-size: 13px;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            margin: 10px 5px;
        }

        .btn-primary {
            background: #CFAA8A;
            color: #fff;
        }

        .btn-outline {
            border: 1px solid #CFAA8A;
            color: #CFAA8A;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Thank You for Your Purchase!</h1>
            <p>Order #{{ $order->id }} | {{ $order->created_at->format('d M, Y') }}</p>
        </div>

        <div class="body">
            <!-- Customer Info -->
            <div class="info">
                <h2>Customer Information</h2>
                <p><strong>{{ $order->address->full_name }}</strong></p>
                <p>{{ $order->address->street_address }}</p>
                <p>{{ $order->address->district }}, {{ $order->address->zip_code }}</p>
                <p>Phone: {{ $order->address->phone }}</p>
                @if (!empty($order->address->email))
                    <p>Email: {{ $order->address->email }}</p>
                @endif
            </div>

            <!-- Order Details Table -->
            <h2>Order Summary</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Product</th>
                        <th style="width: 15%;">Quantity</th>
                        <th style="width: 20%;">Price</th>
                        <th style="width: 15%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                            <td>{{ $item->quantity ?? 0 }}</td>
                            <td>{{ Number::currency($item->unit_amount ?? 0, 'BDT') }}</td>
                            <td>{{ Number::currency(($item->unit_amount ?? 0) * ($item->quantity ?? 0), 'BDT') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <div class="total">
                <p>Subtotal: <strong>{{ Number::currency($order->grand_total ?? 0, 'BDT') }}</strong></p>
                <p>Discount: <strong>0</strong></p>
                <p>Delivery Charge: <strong>{{ Number::currency($delivery_charge ?? 0, 'BDT') }}</strong></p>
                <p style="font-size:17px; margin-top:10px;">Total:
                    <strong>{{ Number::currency($order->grand_total ?? 0 + $delivery_charge ?? 0, 'BDT') }}</strong>
                </p>
                <p>Payment Method:
                    <strong>{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'bkash Payment' }}</strong>
                </p>
                {{-- <p>Payment Status: <strong>{{ $order->payment_method == 'cod' ? 'Pending' : 'Paid' }}</strong></p>
                --}}
            </div>

            <!-- Buttons -->
            <div style="text-align:center; margin-top:30px;">
                <a href="{{ route('order.details', $order->id) }}" class="btn btn-primary text-black">View Order</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>