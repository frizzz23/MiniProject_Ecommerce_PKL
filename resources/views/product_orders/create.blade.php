<!-- resources/views/product_orders/create.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Tambah Produk Pesanan</h1>

    <form action="{{ route('product_orders.store') }}" method="POST">
        @csrf

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
            <label for="order_id" class="form-label">Pesanan</label>
            <select name="order_id" id="order_id" class="form-control" required>
                <option value="">Pilih Pesanan</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">Pesanan #  {{ $order->user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('product-orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
