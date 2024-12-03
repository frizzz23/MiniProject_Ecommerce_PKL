@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Semua Produk</h5>

                    <!-- Tombol Tambah Produk -->
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Produk</button>

                    <div class="row mb-3">
                        <!-- Filter kategori di kiri -->
                        <div class="col-md-6">
                            <form action="{{ route('admin.products.index') }}" method="GET">
                                <div class="d-flex align-items-center">
                                    <select name="category_id" class="form-select me-2" style="width: 200px;">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == request('category_id') ? 'selected' : '' }}>
                                                {{ $category->name_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>

                        <!-- Pencarian di kanan -->
                        <div class="col-md-6 text-end">
                            <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                                <div class="d-flex align-items-center justify-content-end">
                                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk"
                                        value="{{ request('search') }}" style="width: 200px;">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $product->image_product) }}" class="card-img-top"
                                        alt="Gambar Produk" style="max-height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name_product }}</h5>
                                        <p class="card-text text-truncate" style="max-width: 100%;">
                                            {{ $product->description_product }}</p>
                                        <p class="card-text">
                                            <strong>Harga:</strong> Rp
                                            {{ number_format($product->price_product, 0, ',', '.') }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Kategori:</strong> {{ $product->category->name_category }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Stok:</strong> {{ $product->stock_product }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal_{{ $product->id }}">Edit</button>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#descModal_{{ $product->id }}">Deskripsi Produk</button>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal untuk Deskripsi -->
                            <div class="modal fade" id="descModal_{{ $product->id }}" tabindex="-1"
                                aria-labelledby="descModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="descModalLabel_{{ $product->id }}">Deskripsi
                                                Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{!! nl2br(e($product->description_product)) !!}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal untuk Edit -->
                            <div class="modal fade" id="editModal_{{ $product->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel_{{ $product->id }}">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name_product" class="form-label">Nama Produk</label>
                                                    <input type="text" name="name_product" id="name_product"
                                                        class="form-control"
                                                        value="{{ $product->name_product }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description_product" class="form-label">Deskripsi
                                                        Produk</label>
                                                    <textarea name="description_product" id="description_product" class="form-control"
                                                        rows="3" required>{{ $product->description_product }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_product" class="form-label">Harga</label>
                                                    <input type="number" name="price_product" id="price_product"
                                                        class="form-control" value="{{ $product->price_product }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stock_product" class="form-label">Stok</label>
                                                    <input type="number" name="stock_product" id="stock_product"
                                                        class="form-control" value="{{ $product->stock_product }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image_product" class="form-label">Gambar Produk</label>
                                                    <input type="file" name="image_product" id="image_product"
                                                        class="form-control">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Kategori</label>
                                                    <select name="category_id" id="category_id" class="form-select"
                                                        required>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                {{ $category->name_category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" id="name_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" id="description_product" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price_product" class="form-label">Harga</label>
                            <input type="number" name="price_product" id="price_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_product" class="form-label">Stok</label>
                            <input type="number" name="stock_product" id="stock_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" id="image_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
