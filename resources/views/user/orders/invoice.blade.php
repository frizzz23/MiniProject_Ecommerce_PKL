    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Nota Pesanan</title>
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 40px;
            }

            .invoice-container {
                max-width: 700px;
                background: #fff;
                padding: 20px;
                margin: auto;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            .header {
                text-align: center;
                margin-bottom: 30px;
            }

            .header img {
                max-width: 100px;
            }

            .bold {
                font-weight: bold;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th,
            td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            .total-section {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="invoice-container">
            <div class="header">
                <img src="{{ public_path('img/logoo.png') }}" alt="ZenTech">
                <h2>Nota Pesanan</h2>
            </div>
            <table>
                <tr>
                    <td class="bold">Nama Pembeli:</td>
                    <td>{{ $order->user->name }}</td>
                    <td class="bold">Nama Penjual:</td>
                    <td>ZenTech</td>
                </tr>
                <tr>
                    <td class="bold">Alamat Pembeli:</td>
                    <td colspan="3">{{ $order->addresses->address }}</td>
                </tr>
                <tr>
                    <td class="bold">No. Handphone:</td>
                    <td>{{ $order->addresses->no_telepon }}</td>
                </tr>
                <tr>
                    <td class="bold">No. Pesanan:</td>
                    <td>{{ $order->order_code }}</td>
                    <td class="bold">Waktu Pembayaran:</td>
                    <td>{{ \Carbon\Carbon::parse($order->payment->updated_at)->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}
                        WIB</td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td class="bold">Metode Pembayaran:</td>
                    <td>{{ ucwords(str_replace('_', ' ', $order->payment->payment_method)) }}</td>
                </tr>
            </table>

            <h3>Rincian Pesanan</h3>
            <table>
                <thead>
                    <tr class="bold">
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->productOrders as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name_product }}</td>
                            <td>Rp {{ number_format($item->product->price_product, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->quantity * $item->product->price_product, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <table style="width: 300px; margin-left: auto;">
                    <tr>
                        <td>Subtotal:</td>
                        <td>Rp {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Ongkos Kirim:</td>
                        <td>Rp {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <td>- Rp
                            {{ $order->promoCode?->discount_amount ? number_format($order->promoCode->discount_amount, 0, ',', '.') : '0' }}
                        </td>
                    </tr>
                    <tr class="bold">
                        <td>Total Pembayaran:</td>
                        <td>Rp {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

    </html>
