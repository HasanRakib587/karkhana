<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:6px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="padding: 20px; text-align:center; background:#AE9375;">
                            <h2 style="margin:0; color:#000000;">
                                {{ config('app.name') }}
                            </h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px; color:#333;">
                            <p>Hello {{ $order->customer->name ?? 'there' }},</p>

                            <p>
                                We’re happy to let you know that your <strong>payment has been successfully
                                    confirmed</strong>.
                            </p>

                            <h3 style="margin-top:25px;">🧾 Payment Details</h3>
                            <ul style="padding-left:18px;">
                                <li><strong>Order ID:</strong> {{ $order->id }}</li>
                                <li><strong>Payment Method:</strong> bKash</li>
                                <li><strong>Date:</strong> {{ now()->format('F j, Y') }}</li>
                            </ul>

                            <!-- View Order Button -->
                            <p style="text-align:center; margin: 35px 0;">
                                <a href="{{ route('my.orders', $order->id) }}"
                                    style="background:#AE9375; color:#ffffff; text-decoration:none; padding:12px 24px; border-radius:4px; display:inline-block;">
                                    View Your Order
                                </a>
                            </p>

                            <p>
                                If you have any questions or notice anything incorrect, feel free to contact us.
                            </p>

                            <!-- Support -->
                            <p>
                                📞 <strong>Support Phone / WhatsApp:</strong><br>
                                <a href="https://wa.me/01848572772" style="color:#202020; text-decoration:none;">
                                    +88 01848572772
                                </a>
                            </p>

                            <p style="margin-top:30px;">
                                Thank you for choosing <strong>{{ config('app.name') }}</strong>.
                            </p>

                            <p>
                                Warm regards,<br>
                                <strong>{{ config('app.name') }} Team</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px; background:#f8f8f8; text-align:center; font-size:13px; color:#666;">
                            <p style="margin-bottom:10px;">Follow us</p>
                            <a href="https://facebook.com/yourpage" style="margin:0 8px; color:#333;">Facebook</a>
                            <a href="https://twitter.com/yourhandle" style="margin:0 8px; color:#333;">Twitter</a>
                            <a href="https://instagram.com/yourpage" style="margin:0 8px; color:#333;">Instagram</a>

                            <p style="margin-top:15px;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>