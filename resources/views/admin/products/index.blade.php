@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="card w-full">
                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Produk</h5>

                    <!-- Pencarian dan Filter -->
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
                                <div class="d-flex align-items-center">
                                    <select name="category_id"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        style="width: 200px;" onchange="document.getElementById('filterForm').submit();">
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
                                    <option value="1" {{ request('stock_product') == '1' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="0" {{ request('stock_product') == '0' ? 'selected' : '' }}>Habis
                                    </option>
                                </select>
                            </div>
                            <div>
                                <select name="created_at"
                                    class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="this.form.submit()">
                                    <option value="">Tanggal</option>
                                    <option value="asc" {{ request('created_at') == 'asc' ? 'selected' : '' }}>Lama
                                    </option>
                                    <option value="desc" {{ request('created_at') == 'desc' ? 'selected' : '' }}>Terbaru
                                    </option>
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
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                alt="{{ $product->name_product }}" class="w-8 h-8 rounded-full mr-3">
                                            <span>{{ $product->name_product }}</span>
                                        </td>
                                        <td class="px-6 py-5">{{ $product->category->name_category ?? '-' }}</td>
                                        <td class="px-6 py-5">{{ $product->brand->name_brand ?? '-' }}</td>
                                        <td class="px-6 py-5">Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">{{ $product->stock_product }} unit</td>
                                        <td class="px-6 py-5">
                                            {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) . ' / 5' : 'Belum ada' }}
                                        </td>
                                        <td class="px-6 py-5 text-center">{{ $product->created_at->format('d F Y') }}</td>
                                        <td class="px-6 py-5 text-center space-x-2 flex">
                                            <!-- Edit Button with Tooltip -->
                                            <div class="relative group inline-block">
                                                <button class="bg-yellow-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-yellow-600 "
                                                    data-bs-toggle="modal" data-bs-target="#editModal_{{ $product->id }}">
                                                    <i class="fas fa-pen text-sm"></i>
                                                </button>
                                                <span
                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                    <span
                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                    Edit
                                                </span>
                                            </div>

                                            <!-- Detail Button with Tooltip -->
                                            <div class="relative group inline-block">
                                                <a href="{{ route('admin.products.show', $product->slug) }}"
                                                    class="bg-blue-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-blue-600 ">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </a>
                                                <span
                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                    <span
                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                    Detail
                                                </span>
                                            </div>

                                            {{-- <a href="{{ route('admin.products.show', $product->slug) }}">show</a> --}}

                                            <!-- Delete Button with Tooltip -->
                                            <div class="relative group inline-block">
                                                <button class="bg-red-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-red-600 "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal_{{ $product->id }}">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                                <span
                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                    <span
                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                    Hapus
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="details_{{ $product->id }}" class="hidden">
                                        <td colspan="8" class="px-4 py-2 bg-gray-50">
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

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal .modal-body {
            max-height: 70vh;
            /* Mengatur tinggi maksimal modal */
            overflow-y: auto;
            /* Mengaktifkan scroll vertikal */
        }

        .modal .modal-body::-webkit-scrollbar {
            width: 0;
            /* Menyembunyikan scrollbar */
        }

        .modal .modal-body {
            -ms-overflow-style: none;
            /* Untuk Internet Explorer */
            scrollbar-width: none;
            /* Untuk Firefox */
        }
    </style>

    @foreach ($products as $product)
        <div class="modal fade {{ old('product_id') == $product->id ? 'show' : '' }}" id="editModal_{{ $product->id }}"
            tabindex="-1" aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true"
            style="{{ old('product_id') == $product->id ? 'display: block;' : '' }}">
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
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="modal-body">
                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label for="name_product_{{ $product->id }}" class="form-label">Nama Produk</label>
                                <input type="text" name="name_product" class="form-control"
                                    value="{{ $product->name_product }}">
                                @if (old('product_id') == $product->id)
                                    @error('name_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Harga dan Stok -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price_product_{{ $product->id }}" class="form-label">Harga</label>
                                    <input type="number" name="price_product" class="form-control"
                                        value="{{ $product->price_product }}">
                                    @if (old('product_id') == $product->id)
                                        @error('price_product')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stock_product_{{ $product->id }}" class="form-label">Stok</label>
                                    <input type="number" name="stock_product" class="form-control"
                                        value="{{ $product->stock_product }}">
                                    @if (old('product_id') == $product->id)
                                        @error('stock_product')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <!-- Kategori dan Merek -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id_{{ $product->id }}" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('product_id') == $product->id ? old('category_id') : $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                    @if (old('product_id') == $product->id)
                                        @error('category_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="brand_id_{{ $product->id }}" class="form-label">Merek</label>
                                    <select name="brand_id" class="form-select">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ (old('product_id') == $product->id ? old('brand_id') : $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name_brand }}</option>
                                        @endforeach
                                    </select>
                                    @if (old('product_id') == $product->id)
                                        @error('brand_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <!-- Deskripsi Produk -->
                            <div class="mb-3">
                                <label for="description_product_{{ $product->id }}" class="form-label">Deskripsi
                                    Produk</label>
                                <textarea name="description_product" class="form-control" rows="3">{{ old('product_id') == $product->id ? old('description_product') : $product->description_product }}</textarea>
                                @if (old('product_id') == $product->id)
                                    @error('description_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Gambar Produk -->
                            <div class="mb-3">
                                <label for="image_product_{{ $product->id }}" class="form-label">Gambar Produk</label>
                                <input type="file" name="image_product" class="form-control">
                                @if (old('product_id') == $product->id)
                                    @error('image_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
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
    @endforeach


    <div class="modal fade {{ old('product_id') ? '' : ($errors->any() ? 'show' : '') }}" id="addModal" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true"
        style="{{ old('product_id') ? '' : ($errors->any() ? 'display: block;' : '') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Nama Produk -->
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" class="form-control" placeholder="Nama Produk">
                            @if (!old('product_id'))
                                @error('name_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Harga dan Stok -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price_product" class="form-label">Harga</label>
                                <input type="number" name="price_product" class="form-control" placeholder="Harga">
                                @if (!old('product_id'))
                                    @error('price_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock_product" class="form-label">Stok</label>
                                <input type="number" name="stock_product" class="form-control" placeholder="Stok">
                                @if (!old('product_id'))
                                    @error('stock_product')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <!-- Kategori dan Merek -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" class="form-select">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                                @if (!old('product_id'))
                                    @error('category_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brand_id" class="form-label">Merek</label>
                                <select name="brand_id" class="form-select">
                                    <option value="" disabled selected>Pilih Merek</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name_brand }}</option>
                                    @endforeach
                                </select>
                                @if (!old('product_id'))
                                    @error('brand_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" class="form-control" rows="3"placeholder="Deskripsi Produk"></textarea>
                            @if (!old('product_id'))
                                @error('description_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Gambar Produk -->
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" class="form-control">
                            @if (!old('product_id'))
                                @error('image_product')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
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


    <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (old('product_id'))
                    // Jika terdapat error pada modal edit
                    var editModalId = 'editModal_' + '{{ old('product_id') }}';
                    var editModal = new bootstrap.Modal(document.getElementById(editModalId));
                    editModal.show();
                @else
                    // Jika terdapat error pada modal tambah
                    var addModal = new bootstrap.Modal(document.getElementById('addModal'));
                    addModal.show();
                @endif
            });
        </script>
    @endif

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




{{-- <div class="modal fade" id="detailProductModal{{ $product->id }}" tabindex="-1"
                                        aria-labelledby="detailProductModalLabel{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="detailProductModalLabel{{ $product->id }}">
                                                        Detail Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form inside modal -->

                                                    <!-- Form fields for editing -->
                                                    <div class="mb-3">
                                                        <div
                                                            class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                                alt="{{ $product->name_product }}"
                                                                class="w-8 h-8 rounded-full mr-3">

                                                            <span>{{ $product->name_product }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Infromasi Produk</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>Kategori</span>
                                                            <span>:</span>
                                                            <span>{{ $product->category->name_category ?? '-' }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>Brand</span>
                                                            <span>:</span>
                                                            <span>{{ $product->brand->name_brand ?? '-' }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>Rating</span>
                                                            <span>:</span>
                                                            <span>
                                                                {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) . ' / 5' : 'Belum ada' }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>Stok</span>
                                                            <span>:</span>
                                                            <span>{{ $product->stock_product }} unit</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>Harga</span>
                                                            <span>:</span>
                                                            <span>Rp.
                                                                {{ number_format($product->price_product, 0, ',', '.') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-2 text-right">
                                                        <div class="text-xs">Dibuat :
                                                            {{ $product->created_at->translatedFormat('d F Y') }}</div>
                                                        <div class="text-xs">Diperbarui :
                                                            {{ $product->updated_at->translatedFormat('d F Y') }}</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
