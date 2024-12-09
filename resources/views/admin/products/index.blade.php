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
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addModal">Tambah
                        Produk</button>

                    <div class="row mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Pencarian -->
                            <div>
                                <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search" class="form-control me-2"
                                            placeholder="Cari produk" value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Filter kategori -->
                            <div>
                                <form id="filterForm" action="{{ route('admin.products.index') }}" method="GET">
                                    <div class="d-flex align-items-center">
                                        <select name="category_id" class="form-select me-2" style="width: 200px;"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == request('category_id') ? 'selected' : '' }}>
                                                    {{ $category->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
                                <a href="{{ route('admin.products.show', $product->id) }}">
                                    <div
                                        class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 border border-gray-100">
                                        <!-- Gambar Produk -->
                                        <div class="relative overflow-hidden">
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                alt="{{ $product->name_product }}"
                                                class="w-full h-56 object-cover rounded-t-xl transition-transform duration-300 hover:scale-110">
                                            <div class="absolute top-2 right-2">
                                                <span
                                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">New</span>
                                            </div>
                                        </div>

                                        <!-- Informasi Produk -->
                                        <div class="p-4">
                                            <h3 class="text-xl font-bold text-gray-800 truncate">
                                                {{ $product->name_product }}</h3>
                                            <div class="text-m font-extrabold text-blue-600 mb-3">
                                                Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                            </div>

                                            <!-- Tombol Aksi -->
                                            <div class="flex justify-between items-center">
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal_{{ $product->id }}">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Modal untuk Edit -->
                            <div class="modal fade" id="editModal_{{ $product->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel_{{ $product->id }}">Edit Produk
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name_product" class="form-label">Nama Produk</label>
                                                    <input type="text" name="name_product" class="form-control"
                                                        value="{{ $product->name_product }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description_product" class="form-label">Deskripsi
                                                        Produk</label>
                                                    <textarea name="description_product" class="form-control" rows="3" required>{{ $product->description_product }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_product" class="form-label">Harga</label>
                                                    <input type="number" name="price_product" class="form-control"
                                                        value="{{ $product->price_product }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stock_product" class="form-label">Stok</label>
                                                    <input type="number" name="stock_product" class="form-control"
                                                        value="{{ $product->stock_product }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image_product" class="form-label">Gambar Produk</label>
                                                    <input type="file" name="image_product" class="form-control">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                        gambar.</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Kategori</label>
                                                    <select name="category_id" class="form-select" required>
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
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price_product" class="form-label">Harga</label>
                            <input type="number" name="price_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_product" class="form-label">Stok</label>
                            <input type="number" name="stock_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
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
