@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="card w-full">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Merek</h5>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <button class="btn btn-primary text-white font-medium py-2 px-4 rounded-lg"
                                    data-bs-toggle="modal" data-bs-target="#addModal">+ Tambahkan produk baru</button>
                                <!-- Filter Kategori -->
                                <form id="filterForm" action="{{ route('admin.products.index') }}" method="GET">
                                    <div class="d-flex align-items-center ">
                                        <select name="category_id"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            style="width: 200px;"
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
                        <form action="{{ route('admin.products.index') }}" method="GET">
                            <div class="grid grid-cols-4 gap-4 text-white border-t border-gray-600 pt-4 mb-4">
                                <div>
                                    <select name="brand_id"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Merek</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name_brand }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select name="price_product"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Harga</option>
                                        <option value="asc" {{ request('price_product') == 'asc' ? 'selected' : '' }}>
                                            Terendah
                                            ke Tertinggi</option>
                                        <option value="desc" {{ request('price_product') == 'desc' ? 'selected' : '' }}>
                                            Tertinggi
                                            ke Terendah</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="stock_product"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Stok</option>
                                        <option value="1" {{ request('stock_product') == '1' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="0" {{ request('stock_product') == '0' ? 'selected' : '' }}>
                                            Habis
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <select name="color_product"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Warna</option>
                                        <!-- Tambahkan opsi warna jika diperlukan -->
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th class="px-4 py-2 text-left">Nama Produk</th>
                                    <th class="px-4 py-2 text-left">Kategori</th>
                                    <th class="px-4 py-2 text-left">Merek</th>
                                    <th class="px-4 py-2 text-left">Harga</th>
                                    <th class="px-4 py-2 text-left">Stok</th>
                                    <th class="px-4 py-2 text-left">Rating</th>
                                    <th class="px-6 py-2 text-center">Dibuat</th>
                                    <th class="px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr onclick="toggleDropdown(this)" class="hover:bg-gray-50 cursor-pointer border-b">
                                        <td class="px-4 py-2 flex items-center">
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                alt="{{ $product->name_product }}" class="w-8 h-8 rounded-full mr-3">
                                                <span>
                                                    {{ $product->name_product }}
                                                </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $product->category->name_category ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $product->brand->name_brand ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $product->stock_product }} unit
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) . ' / 5' : 'Belum ada' }}
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            {{ $product->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="px-4 py-2 text-center space-x-2">
                                            <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal_{{ $product->id }}">Edit</button>
                                            <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailModal_{{ $product->id }}">Detail</button>
                                            <button type="button" class="bg-red-500 text-white px-3 py-1 rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal_{{ $product->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr class="dropdown-content hidden">
                                        <td colspan="5" class="px-4 py-2 bg-gray-50">
                                            <div class="flex items-center space-x-4">
                                                @if ($product->image_product)
                                                    <img src="{{ asset('storage/' . $product->image_product) }}"
                                                        alt="{{ $product->name_product }}"
                                                        class="w-24 h-24 object-cover rounded">
                                                @endif
                                                <div>
                                                    <strong>Deskripsi:</strong>
                                                    <p>{{ $product->description_product }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
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
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <!-- Nama Produk -->
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" class="form-control" placeholder="Nama Produk"
                                value="{{ old('name_product') }}">
                            @error('name_product')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga dan Stok (Satu Baris) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price_product" class="form-label">Harga</label>
                                <input type="number" name="price_product" class="form-control"
                                    value="{{ old('price_product') }}">
                                @error('price_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock_product" class="form-label">Stok</label>
                                <input type="number" name="stock_product" class="form-control"
                                    value="{{ old('stock_product') }}">
                                @error('stock_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kategori dan Merek (Satu Baris) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" class="form-select">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brand_id" class="form-label">Merek</label>
                                <select name="brand_id" class="form-select">
                                    <option value="" disabled selected>Pilih Merek</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name_brand }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" class="form-control" rows="3">{{ old('description_product') }}</textarea>
                            @error('description_product')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar Produk -->
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" class="form-control">
                            @error('image_product')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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


    {{-- <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var addModal = new bootstrap.Modal(document.getElementById('addModal'));
                addModal.show();
            });
        </script>
    @endif --}}

    <!-- Modal Edit Produk -->
    @foreach ($products as $product)
        <div class="modal fade" id="editModal_{{ $product->id }}" tabindex="-1"
            aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_{{ $product->id }}">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label for="name_product_{{ $product->id }}" class="form-label">Nama Produk</label>
                                <input type="text" name="name_product" class="form-control"
                                    value="{{ old('name_product') ?? $product->name_product }}" >
                                @error('name_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stok dan Harga -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="stock_product_{{ $product->id }}" class="form-label">Stok</label>
                                    <input type="number" name="stock_product" class="form-control"
                                        value="{{ old('stock_product') ?? $product->stock_product }}" >
                                    @error('stock_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price_product_{{ $product->id }}" class="form-label">Harga</label>
                                    <input type="number" name="price_product" class="form-control"
                                        value="{{ old('price_product') ?? $product->price_product }}" >
                                    @error('price_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kategori dan Merek -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id_{{ $product->id }}" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-select" >
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id')  ?? $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="brand_id_{{ $product->id }}" class="form-label">Merek</label>
                                    <select name="brand_id" class="form-select" >
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id') ?? $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name_brand }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Deskripsi Produk -->
                            <div class="mb-3">
                                <label for="description_product_{{ $product->id }}" class="form-label">Deskripsi
                                    Produk</label>
                                <textarea name="description_product" class="form-control" rows="3" >{{ old('description_product') ?? $product->description_product }}</textarea>
                                @error('description_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar Produk -->
                            <div class="mb-3">
                                <label for="image_product_{{ $product->id }}" class="form-label">Gambar Produk</label>
                                <input type="file" name="image_product" class="form-control">
                                @error('image_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal Hapus Produk -->
    @foreach ($products as $product)
        <div class="modal fade" id="deleteModal_{{ $product->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel_{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel_{{ $product->id }}">Hapus Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus produk <strong>{{ $product->name_product }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        function toggleDropdown(element) {
            var dropdown = element.nextElementSibling;
            dropdown.classList.toggle('hidden');
        }
    </script>
@endsection
