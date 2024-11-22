<!-- resources/views/product_orders/index.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Daftar Produk Pesanan</h1>
    <a href="{{ route('product_orders.create') }}" class="btn btn-primary mb-3">Tambah Produk Pesanan</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
                        <a href="{{ route('product-orders.edit', $productOrder->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('product-orders.destroy', $productOrder->id) }}" method="POST" style="display: inline;">
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
@endsection
