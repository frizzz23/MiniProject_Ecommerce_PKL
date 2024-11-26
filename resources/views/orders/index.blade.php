<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('main')
    <div class="container">
        <h1>Daftar Pesanan</h1>

        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">
            Tambah Pesanan
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Produk</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            @if ($order->productOrders->isNotEmpty())
                                @foreach ($order->productOrders as $productOrder)
                                    <div>{{ $productOrder->product->name_product }}</div>
                                @endforeach
                            @else
                                <div>No products in this order.</div>
                            @endif
                        </td>
                        <td>{{ number_format($order->sub_total_amount, 2) }}</td>
                        <td>{{ number_format($order->grand_total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->status_order) }}</td>
                        <td>
                            <!-- Tombol untuk memunculkan modal edit -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editOrderModal{{ $order->id }}">
                                Edit
                            </button>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Pesanan -->
                    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit Pesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($order->productOrders as $productOrder)
                                            @php
                                                $total +=
                                                    $productOrder->product->price_product * $productOrder->quantity;
                                            @endphp
                                            <input type="hidden"
                                                name="product_id_quantity[{{ $productOrder->product->id }}]"
                                                id="product_id_quantity_{{ $productOrder->id }}"
                                                value="{{ $productOrder->quantity }}">
                                            <div class="border border-2 rounded-md p-4 mb-4">
                                                <div class="mb-3">
                                                    <label for="nama_product_{{ $productOrder->id }}"
                                                        class="form-label">Produk</label>
                                                    <input type="text"
                                                        value="{{ $productOrder->product->name_product }}" id="product_id"
                                                        class="form-control" readonly disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah_{{ $productOrder->id }}"
                                                        class="form-label">Jumlah</label>
                                                    <div
                                                        class="d-flex gap-2 w-25 justify-content-between align-items-center">
                                                        <button type="button"
                                                            onclick="kurang('{{ $productOrder->id }}', {{ $productOrder->product->price_product }}, 'product_id_quantity_{{ $productOrder->id }}')"
                                                            class="btn btn-sm btn-danger">-</button>
                                                        <input type="number" class="form-control"
                                                            id="jumlah_{{ $productOrder->id }}" required
                                                            value="{{ $productOrder->quantity }}" onchange="updatePrice()">
                                                        <button type="button"
                                                            onclick="tambah({{ $productOrder->product->stock_product }}, '{{ $productOrder->id }}', {{ $productOrder->product->price_product }}, 'product_id_quantity_{{ $productOrder->id }}')"
                                                            class="btn btn-sm btn-success">+</button>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <p>Harga Produk : Rp.
                                                        {{ number_format($productOrder->product->price_product, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="border border-2 rounded-md p-4 mb-4">
                                            <div class="mb-3">
                                                <label for="diskon" class="form-label">Kode Diskon</label>
                                                <input type="text" id="diskon" name="diskon" class="form-control"
                                                    onchange="updatePrice()">
                                                <div id="error_diskon" class="text-danger"></div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="total_amount" value="{{ $total }}">
                                                <input type="hidden" name="grand_total_amount" id="grand_total_amount"
                                                    value="{{ $total }}">
                                                <p>Total : Rp. <span
                                                        id='total'>{{ number_format($total, 0, ',', '.') }}</span></p>
                                                <p>Diskon : Rp. <span id="diskon_value">0</span></p>
                                                <p>Harga Total : Rp. <span
                                                        id="harga_total">{{ number_format($total, 0, ',', '.') }}</span>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>
    </div>



    <!-- Modal Bootstrap -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Tambah Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                    <div class="d-flex gap-2 w-25 justify-content-between align-items-center">
                                        <button type="button"
                                            onclick="kurang('{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                            class="btn btn-sm btn-danger">-</button>
                                        <input type="number" class="form-control" id="jumlah_{{ $cart->id }}"
                                            required value="{{ $cart->quantity }}" onchange="updatePrice()">
                                        <button type="button"
                                            onclick="tambah({{ $cart->product->stock_product }}, '{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                            class="btn btn-sm btn-success">+</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p>Harga Produk : Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <div class="border border-2 rounded-md p-4 mb-4">
                            <div class="mb-3">
                                <label for="diskon" class="form-label">Kode Diskon</label>
                                <input type="text" id="diskon" name="diskon" class="form-control"
                                    onchange="updatePrice()">
                                <div id="error_diskon" class="text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="total_amount" value="{{ $total }}">
                                <input type="hidden" name="grand_total_amount" id="grand_total_amount"
                                    value="{{ $total }}">
                                <p>Total : Rp. <span id='total'>{{ number_format($total, 0, ',', '.') }}</span></p>
                                <p>Diskon : Rp. <span id="diskon_value">0</span></p>
                                <p>Harga Total : Rp. <span
                                        id="harga_total">{{ number_format($total, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Fungsi JavaScript tetap sama seperti sebelumnya
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
            // Kode updatePrice tetap sama seperti sebelumnya
        }
    </script>
@endsection
