<!-- resources/views/orders/create.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Tambah Pesanan</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Pengguna</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="product_id" class="form-label">Produk</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="total_order" class="form-label">harga</label>
            <input type="number" name="total_order" id="total_order" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status_order" class="form-label">Status</label>
            <select name="status_order" id="status_order" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
