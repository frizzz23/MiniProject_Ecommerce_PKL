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
                                <div
                                    class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 border border-gray-100">
                                    <!-- Gambar Produk -->
                                    <div class="relative overflow-hidden">
                                        <img src="{{ asset('storage/' . $product->image_product) }}"
                                            alt="{{ $product->name_product }}"
                                            class="w-full h-56 object-cover rounded-t-xl transition-transform duration-300 hover:scale-110">
                                    </div>

                                    <!-- Informasi Produk -->
                                    <div class="p-4">
                                        <h3 class="text-xl font-bold text-gray-800 truncate">
                                            {{ $product->name_product }}
                                        </h3>
                                        <div class="text-m font-extrabold text-blue-600 mb-3">
                                            Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                        </div>

                                        <!-- Tombol Aksi -->
                                        <div class="flex justify-between items-center">
                                            <!-- Tombol Detail -->
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal_{{ $product->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal_{{ $product->id }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal_{{ $product->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Detail Produk -->
                            <div class="modal fade" id="detailModal_{{ $product->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel_{{ $product->id }}">
                                                Detail Produk: {{ $product->name_product }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-5 mb-3">
                                                    <img src="{{ asset('storage/' . $product->image_product) }}"
                                                        alt="{{ $product->name_product }}" class="img-fluid rounded">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="mb-3">
                                                        <strong>Nama Produk:</strong>
                                                        <p>{{ $product->name_product }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Harga:</strong>
                                                        <p class="text-primary">
                                                            Rp {{ number_format($product->price_product, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Kategori:</strong>
                                                        <p>{{ $product->category->name_category }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Stok:</strong>
                                                        <p
                                                            class="{{ $product->stock_product > 0 ? 'text-success' : 'text-danger' }}">
                                                            {{ $product->stock_product }} unit
                                                            ({{ $product->stock_product > 0 ? 'Tersedia' : 'Habis' }})
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Deskripsi:</strong>
                                                        <p class="text-muted">
                                                            {!! nl2br(e($product->description_product)) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Produk -->
                            <div class="modal fade" id="editModal_{{ $product->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel_{{ $product->id }}">
                                                Edit Produk
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
                                                    <img src="{{ asset('storage/' . $product->image_product) }}"
                                                        alt="Image" class="img-thumbnail mt-2" width="150">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Kategori</label>
                                                    <select name="category_id" class="form-control" required>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name_category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" class="form-control"
                                placeholder="cth : Nama Hp / Spesifikasi" required>
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
                        <div>
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal_{{ $product->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel_{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel_{{ $product->id }}">
                        Konfirmasi Hapus Produk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus produk <strong>{{ $product->name_product }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
