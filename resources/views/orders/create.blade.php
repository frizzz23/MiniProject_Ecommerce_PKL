@extends('layouts.app')

@section('main')
    <div class="container">
        <h1>Tambah Pesanan</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            @php
                $total = 0;
            @endphp
            @foreach ($carts as $cart)
                @php
                    $total += $cart->product->price_product * $cart->quantity;
                @endphp
                <input type="hidden" name="product_id_quantity[{{ $cart->product->id }}]"
                    id="product_id_quantity_{{ $cart->id }}" value="{{ $cart->quantity }}">
                <div class="border border-2 rounded-md p-4 mb-4">
                    <div class="mb-3">
                        <label for="nama_product_{{ $cart->id }}" class="form-label">Produk</label>
                        <input type="text" value="{{ $cart->product->name_product }}" id="product_id"
                            class="form-control" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_{{ $cart->id }}" class="form-label">Jumlah</label>
                        <div class="flex gap-2 w-25 justify-content-between align-items-center">
                            <button type="button"
                                onclick="kurang('{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                class="btn btn-sm btn-danger">-</button>
                            <input type="number" class="form-control"id="jumlah_{{ $cart->id }}" required
                                value="{{ $cart->quantity }}" onchange="updatePrice()">
                            <button type="button"
                                onclick="tambah({{ $cart->product->stock_product }}, '{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                class="btn btn-sm btn-success">+</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p>Harga Produk : Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach


            <div class="border">

            </div>
            <div class="border border-2 rounded-md p-4 mb-4">
                <div class="mb-3">
                    <label for="diskon" class="form-label">Kode Diskon</label>
                    <input type="text" id="diskon" name="diskon" class="form-control" onchange="updatePrice()">
                    <div id="error_diskon" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="total_amount" value="{{ $total }}">
                    <input type="hidden" name="grand_total_amount" id="grand_total_amount" value="{{ $total }}">
                    <p>Diskon : Rp. <span id="diskon_value">0</span></p>
                    <p>Harga Total : Rp. <span id="harga_total">{{ number_format($total, 0, ',', '.') }}</span></p>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        // Fungsi untuk mengurangi jumlah produk
        function kurang(id, price, id_quantity) {
            const jumlah = document.getElementById("jumlah_" + id);
            if (jumlah.value > 0) {
                jumlah.value = parseInt(jumlah.value) - 1;
                document.getElementById(id_quantity).value = parseInt(document.getElementById(id_quantity).value) - 1;
                updatePrice();
            }
        }

        // Fungsi untuk menambah jumlah produk
        function tambah(max, id, price, id_quantity) {
            const jumlah = document.getElementById("jumlah_" + id);
            if (jumlah.value < max) {
                jumlah.value = parseInt(jumlah.value) + 1;
                document.getElementById(id_quantity).value = parseInt(document.getElementById(id_quantity).value) + 1;
                updatePrice();
            }
        }

        // Fungsi untuk memperbarui harga total dan diskon
        async function updatePrice() {
            let total = 0;

            // Update harga total berdasarkan jumlah produk
            const carts = @json($carts); // Mengambil data carts dari Blade
            carts.forEach(cart => {
                const quantity = document.getElementById('jumlah_' + cart.id).value;
                const price = cart.product.price_product;
                total += price * quantity;
            });

            // Ambil kode diskon
            const discountCode = document.getElementById('diskon').value;
            const errorDiscount = document.getElementById('error_diskon');
            let discount = 0;

            if (discountCode) {
                // Lakukan request untuk validasi kode promo
                const response = await fetch('/api/validate-promo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        code: discountCode
                    })
                });

                const data = await response.json();
                if (data.status === 'success') {
                    discount = parseInt(data.discount); // Set diskon berdasarkan response dari server
                    errorDiscount.textContent = '';
                } else {
                    document.getElementById('diskon').value = ''; // Hapus kode diskon jika tidak valid
                    errorDiscount.textContent = 'Kode diskon tidak valid!';
                }
            }

            // Update harga total dan diskon
            const discountedTotal = total - discount;
            document.getElementById('diskon_value').textContent = discount.toLocaleString();
            document.getElementById('harga_total').textContent = discountedTotal.toLocaleString();
            document.getElementById('grand_total_amount').value = discountedTotal;
        }
    </script>
@endsection
