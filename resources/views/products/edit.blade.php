<!-- resources/views/products/edit.blade.php -->
@extends('home')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_product" class="form-label">Nama Produk</label>
            <input
                type="text"
                name="name_product"
                class="form-control"
                id="name_product"
                value="{{ old('name_product', $product->name_product) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="description_product" class="form-label">Deskripsi Produk</label>
            <textarea
                name="description_product"
                class="form-control"
                id="description_product"
                required
            >{{ old('description_product', $product->description_product) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price_product" class="form-label">Harga Produk</label>
            <input
                type="number"
                name="price_product"
                class="form-control"
                id="price_product"
                value="{{ old('price_product', $product->price_product) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="stock_product" class="form-label">Stok Produk</label>
            <input
                type="number"
                name="stock_product"
                class="form-control"
                id="stock_product"
                value="{{ old('stock_product', $product->stock_product) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select
                name="category_id"
                class="form-control"
                id="category_id"
                required
            >
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name_category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_product" class="form-label">Gambar Produk</label>
            <input
                type="file"
                name="image_product"
                class="form-control"
                id="image_product"
            >
            @if ($product->image_product)
                <img
                    src="{{ asset('storage/' . $product->image_product) }}"
                    alt="Gambar Produk"
                    class="img-thumbnail mt-2"
                    style="max-width: 200px;"
                >
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
