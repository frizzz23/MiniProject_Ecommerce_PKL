<!-- resources/views/carts/index.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>
    <a href="{{ route('carts.create') }}" class="btn btn-primary mb-3">Tambah Keranjang</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengguna</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carts as $cart)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cart->user->name }}</td>
                    <td>{{ $cart->product->name_product }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>
                        <a href="{{ route('carts.edit', $cart->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Keranjang kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
