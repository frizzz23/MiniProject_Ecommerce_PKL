<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Daftar Pesanan</h1>

    <!-- Tombol untuk memunculkan modal tambah pesanan -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#orderModal">
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
                        @foreach ($order->product as $product)
                            <div>{{ $product->name_product }}</div>
                        @endforeach
                    </td>
                    <td>{{ number_format($order->sub_total_amount, 2) }}</td>
                    <td>{{ number_format($order->grand_total_amount, 2) }}</td>
                    <td>{{ ucfirst($order->status_order) }}</td>
                    <td>
                        <!-- Tombol untuk memunculkan modal edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">
                            Edit
                        </button>

                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;">
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

<!-- Modal Tambah Pesanan -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Tambah Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pengguna</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produk</label>
                        <select name="product_id[]" id="product_id" class="form-select" multiple required>
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                            @endforeach
                        </select>
                            @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>

                            @enderror

                    </div>

                    <div class="mb-3">
                        <label for="sub_total_amount" class="form-label">Subtotal</label>
                        <input type="number" name="sub_total_amount" id="sub_total_amount" class="form-control" >

                        @error('sub_total_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="grand_total_amount" class="form-label">Total</label>
                        <input type="number" name="grand_total_amount" id="grand_total_amount" class="form-control" >
                        @error('grand_total_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_order" class="form-label">Status</label>
                        <select name="status_order" id="status_order" class="form-select" >
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('status_order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pesanan -->
@foreach ($orders as $order)
<div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit Pesanan #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pengguna</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produk</label>
                        <select name="product_id[]" id="product_id" class="form-select" multiple required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ in_array($product->id, $order->product->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $product->name_product }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sub_total_amount" class="form-label">Subtotal</label>
                        <input type="number" name="sub_total_amount" id="sub_total_amount" class="form-control" value="{{ $order->sub_total_amount }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="grand_total_amount" class="form-label">Total</label>
                        <input type="number" name="grand_total_amount" id="grand_total_amount" class="form-control" value="{{ $order->grand_total_amount }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status_order" class="form-label">Status</label>
                        <select name="status_order" id="status_order" class="form-select" required>
                            <option value="pending" {{ $order->status_order == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status_order == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status_order == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
