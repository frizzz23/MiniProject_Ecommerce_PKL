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

                <!-- Pencarian dan Filter -->
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <!-- Pencarian -->
                        <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <input type="text" name="search" class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk" value="{{ request('search') }}" style="width: 200px;">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="btn btn-primary text-white font-medium py-2 px-4 rounded-lg" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambahkan produk baru</button>
                        <!-- Filter Kategori -->
                        <form id="filterForm" action="{{ route('admin.products.index') }}" method="GET">
                            <div class="d-flex align-items-center">
                                <select name="category_id" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full" style="width: 200px;" onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == request('category_id') ? 'selected' : '' }}>
                                            {{ $category->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <form action="{{ route('admin.products.index') }}" method="GET">
                        <div class="grid grid-cols-5 gap-4 text-white border-t border-gray-600 pt-4 mb-4">
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
                                        Terendah ke Tertinggi</option>
                                    <option value="desc" {{ request('price_product') == 'desc' ? 'selected' : '' }}>
                                        Tertinggi ke Terendah</option>
                                </select>
                            </div>
                            <div>
                                <select name="rating"
                                    class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="this.form.submit()">
                                    <option value="">Rating</option>
                                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                                </select>
                            </div>
                            <div>
                                <select name="stock_product"
                                    class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="this.form.submit()">
                                    <option value="">Stok</option>
                                    <option value="1" {{ request('stock_product') == '1' ? 'selected' : '' }}>Ada</option>
                                    <option value="0" {{ request('stock_product') == '0' ? 'selected' : '' }}>Habis</option>
                                </select>
                            </div>
                            <div>
                                <select name="created_at"
                                    class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="this.form.submit()">
                                    <option value="">Tanggal</option>
                                    <option value="asc" {{ request('created_at') == 'asc' ? 'selected' : '' }}>Lama</option>
                                    <option value="desc" {{ request('created_at') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                            </div>
                        </div>
                    </form>

                <!-- Daftar Produk -->
                <div class="table-responsive">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Table Head -->
                        <thead class="bg-[#5D87FF] text-white">
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
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50 cursor-pointer border-b">
                                    <td class="px-6 py-6 flex items-center">
                                        <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}" class="w-8 h-8 rounded-full mr-3">
                                        <span>{{ $product->name_product }}</span>
                                    </td>
                                    <td class="px-6 py-5">{{ $product->category->name_category ?? '-' }}</td>
                                    <td class="px-6 py-5">{{ $product->brand->name_brand ?? '-' }}</td>
                                    <td class="px-6 py-5">Rp. {{ number_format($product->price_product, 0, ',', '.') }}</td>
                                    <td class="px-6 py-5">{{ $product->stock_product }} unit</td>
                                    <td class="px-6 py-5">{{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) . ' / 5' : 'Belum ada' }}</td>
                                    <td class="px-6 py-5 text-center">{{ $product->created_at->format('d F Y') }}</td>
                                    <td class="px-6 py-5 text-center space-x-2 flex">
                                        <!-- Edit Button with Tooltip -->
                                        <div class="relative group inline-block">
                                            <button class="bg-yellow-500 text-white px-3 py-1 rounded flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L8 9.172 7 13l3.828-1L17.414 5.414a2 2 0 000-2.828l-1-1zM15 4l1-1L15 2l-1 1 1 1zM4 13v3h3l9-9-3-3L4 13z" />
                                                </svg>
                                            </button>
                                            <span
                                                class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                <span class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                Edit
                                            </span>
                                        </div>

                                        <!-- Detail Button with Tooltip -->
                                        <div class="relative group inline-block">
                                            <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded flex items-center" onclick="toggleDetails({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-3.866 0-7-4.134-7-5s3.134-5 7-5 7 4.134 7 5-3.134 5-7 5zm0-8c-1.103 0-2 2.015-2 3s.897 3 2 3 2-2.015 2-3-.897-3-2-3z"/>
                                                </svg>
                                            </button>
                                            <span
                                                class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                <span class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                Detail
                                            </span>
                                        </div>

                                        <a href="{{ route('admin.products.show', $product->slug) }}">show</a>

                                        <!-- Delete Button with Tooltip -->
                                        <div class="relative group inline-block">
                                            <button class="bg-red-500 text-white px-3 py-1 rounded flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 4a1 1 0 000 2h8a1 1 0 100-2H6zM3 6a1 1 0 011-1h12a1 1 0 011 1v11a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 9a1 1 0 102 0V8a1 1 0 00-2 0v7zm5-1a1 1 0 10-2 0V8a1 1 0 112 0v6z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <span
                                                class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                <span class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                Hapus
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="details_{{ $product->id }}" class="hidden">
                                    <td colspan="8" class="px-4 py-2 bg-gray-50">
                                        <div class="flex items-center space-x-4">
                                            @if ($product->image_product)
                                                <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}" class="w-24 h-24 object-cover rounded">
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

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function toggleDetails(productId) {
        const detailsRow = document.getElementById(`details_${productId}`);
        if (detailsRow) {
            detailsRow.classList.toggle('hidden');
        }
    }
</script> --}}  


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
