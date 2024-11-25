<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('main')
    <div class="container">
        <h1>Daftar Pesanan</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Product</th>
                    <th>Total Harga</th>
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
                            <table>

                                @foreach ($order->productOrders as $product_order)
                                    <tr>
                                        <th>
                                            {{ $product_order->product->name_product }}
                                        </th>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            Rp.
                                            {{ number_format($product_order->product->price_product, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            jumlah
                                            {{ $product_order->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </td>
                        <td>Rp. {{ number_format($order->grand_total_amount, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($order->status_order) }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
