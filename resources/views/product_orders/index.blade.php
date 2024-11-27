@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Daftar Produk Pesanan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button untuk membuka modal tambah produk pesanan -->
    <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#productOrderModal">
        Tambah Produk ke Pesanan (Modal)
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>ID Pesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productOrders as $productOrder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $productOrder->product->name_product }}</td>
                    <td>{{ $productOrder->order->user->name }}</td>
                    <td>
                        <!-- Button untuk membuka modal edit produk pesanan -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductOrderModal-{{ $productOrder->id }}">
                            Edit
                        </button>

                        <form action="{{ route('product_orders.destroy', $productOrder->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk menambah produk pesanan -->
<div class="modal fade" id="productOrderModal" tabindex="-1" aria-labelledby="productOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productOrderModalLabel">Tambah Produk Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product_orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="product_id_modal" class="form-label">Produk</label>
                        <select name="product_id" id="product_id_modal" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="order_id_modal" class="form-label">Pesanan</label>
                        <select name="order_id" id="order_id_modal" class="form-control" required>
                            <option value="">Pilih Pesanan</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">Pesanan #  {{ $order->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengedit produk pesanan -->

<div class="modal fade" id="editProductOrderModal-{{ $productOrder->id }}" tabindex="-1" aria-labelledby="editProductOrderModalLabel-{{ $productOrder->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductOrderModalLabel-{{ $productOrder->id }}">Edit Produk Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product_orders.update', $productOrder->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="product_id_modal_edit" class="form-label">Produk</label>
                        <select name="product_id" id="product_id_modal_edit" class="form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $productOrder->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name_product }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="order_id_modal_edit" class="form-label">Pesanan</label>
                        <select name="order_id" id="order_id_modal_edit" class="form-control" required>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}" {{ $productOrder->order_id == $order->id ? 'selected' : '' }}>
                                    Pesanan # {{ $order->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
