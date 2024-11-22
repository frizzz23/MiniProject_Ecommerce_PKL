<!-- resources/views/orders/edit.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Edit Pesanan</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Pengguna</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Produk</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name_product }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="total_order" class="form-label">harga</label>
            <input type="number" name="total_order" id="total_order" class="form-control" value="{{ $order->total_order }}" required>
        </div>

        <div class="mb-3">
            <label for="status_order" class="form-label">Status</label>
            <select name="status_order" id="status_order" class="form-control" required>
                <option value="pending" {{ $order->status_order == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status_order == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status_order == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
