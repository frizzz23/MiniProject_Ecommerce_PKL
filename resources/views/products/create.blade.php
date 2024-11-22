<!-- resources/views/products/create.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Tambah Produk Baru</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name_product" class="form-label">Nama Produk</label>
            <input type="text" name="name_product" class="form-control" id="name_product" required>
        </div>

        <div class="mb-3">
            <label for="description_product" class="form-label">Deskripsi Produk</label>
            <textarea name="description_product" class="form-control" id="description_product" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price_product" class="form-label">Harga Produk</label>
            <input type="number" name="price_product" class="form-control" id="price_product" required>
        </div>

        <div class="mb-3">
            <label for="stock_product" class="form-label">Stok Produk</label>
            <input type="number" name="stock_product" class="form-control" id="stock_product" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_product" class="form-label">Gambar Produk</label>
            <input type="file" name="image_product" class="form-control" id="image_product">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
        <a href="{{ route('products.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection
