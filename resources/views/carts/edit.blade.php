<!-- resources/views/carts/edit.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Edit Produk di Keranjang</h1>

    <form action="{{ route('carts.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Pengguna</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $cart->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="product_id" class="form-label">Nama Produk</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $cart->product_id == $product->id ? 'selected' : '' }}>{{ $product->name_product }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $cart->quantity }}" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('carts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
