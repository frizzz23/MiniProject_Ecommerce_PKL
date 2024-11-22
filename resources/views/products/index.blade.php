<!-- resources/views/products/index.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name_product }}</td>
                    <td>{{ Str::limit($product->description_product, 50) }}</td>
                    <td>Rp {{ number_format($product->price_product, 0, ',', '.') }}</td>
                    <td>{{ $product->category->name_category }}</td>
                    <td>{{ $product->stock_product }}</td>
                    <td>
                        @if ($product->image_product)
                            <img src="{{ asset('storage/' . $product->image_product) }}" alt="Gambar Produk" class="img-thumbnail mt-2" style="max-width: 200px;">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
