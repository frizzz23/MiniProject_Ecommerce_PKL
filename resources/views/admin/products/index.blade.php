@extends('layouts.admin')

@section('main')
<div class="container mx-auto p-6">
    <div class="card w-full">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Manajemen Produk</h1>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <!-- Pencarian -->
                    <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                        <div class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control me-2 border-lg border-[#5d85fa]"
                                   placeholder="Cari produk"
                                   value="{{ request('search') }}"
                                   style="width: 200px;">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="flex items-center gap-4">
                <button class="btn btn-primary text-white font-medium py-2 px-4 rounded-lg" data-bs-toggle="modal" data-bs-target="#addModal">+ Add new product</button>
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
            <div class="grid grid-cols-4 gap-4 text-white border-t border-gray-600 pt-4 mb-4">
                <div>
                <select class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full">
                    <option>Brand</option>
                </select>
                </div>
                <div>
                <select class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full">
                    <option>Price</option>
                </select>
                </div>
                <div>
                <select class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full">
                    <option>Stock</option>
                </select>
                </div>
                <div>
                <select class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full">
                    <option>Color</option>
                </select>
                </div>
            </div>
        </div>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Produk</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Brand</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                    <th class="px-4 py-2 text-left">Stok</th>
                    <th class="px-4 py-2 text-left">Rating</th>
                    <th class="px-6 py-2 text-center">Last Update</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr onclick="toggleDropdown(this)" class="hover:bg-gray-50 cursor-pointer border-b">
                        <td class="px-4 py-2 flex items-center">
                            <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}" class="w-8 h-8 rounded-full mr-3">
                            {{ $product->name_product }}
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
                            {{ $product->updated_at->format('d-m-Y H:i') }}
                        </td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded" data-bs-toggle="modal" data-bs-target="#editModal_{{ $product->id }}">Edit</button>
                            <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded" data-bs-toggle="modal" data-bs-target="#detailModal_{{ $product->id }}">Detail</button>
                            <button type="button" class="bg-red-500 text-white px-3 py-1 rounded" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $product->id }}">Hapus</button>
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

        <div class="mt-4">
            {{ $products->links() }}
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
                        <input type="text" name="name_product" class="form-control" placeholder="Nama Produk" required>
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
                        <select name="category_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select name="brand_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name_brand }}</option>
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
<!-- Modal Edit Produk -->
@foreach ($products as $product)
<div class="modal fade" id="editModal_{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel_{{ $product->id }}">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name_product_{{ $product->id }}" class="form-label">Nama Produk</label>
                        <input type="text" name="name_product" class="form-control" value="{{ $product->name_product }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description_product_{{ $product->id }}" class="form-label">Deskripsi Produk</label>
                        <textarea name="description_product" class="form-control" rows="3" required>{{ $product->description_product }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price_product_{{ $product->id }}" class="form-label">Harga</label>
                        <input type="number" name="price_product" class="form-control" value="{{ $product->price_product }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_product_{{ $product->id }}" class="form-label">Stok</label>
                        <input type="number" name="stock_product" class="form-control" value="{{ $product->stock_product }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image_product_{{ $product->id }}" class="form-label">Gambar Produk</label>
                        <input type="file" name="image_product" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="category_id_{{ $product->id }}" class="form-label">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand_id_{{ $product->id }}" class="form-label">Brand</label>
                        <select name="brand_id" class="form-control" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="deleteModal_{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel_{{ $product->id }}" aria-hidden="true">
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
