@extends('layouts.app')

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
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                    Tambah kategori
                </button>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">No</th>
                                <th class="border-bottom-0">Nama Produk</th>
                                <th class="border-bottom-0">Deskripsi</th>
                                <th class="border-bottom-0">Harga</th>
                                <th class="border-bottom-0">Kategori</th>
                                <th class="border-bottom-0">Stok</th>
                                <th class="border-bottom-0">Gambar</th>
                                <th class="border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">{{ $product->name_product }}</td>
                                    <td class="border-bottom-0">{{ Str::limit($product->description_product, 50) }}</td>
                                    <td class="border-bottom-0">Rp {{ number_format($product->price_product, 0, ',', '.') }}</td>
                                    <td class="border-bottom-0">{{ $product->category->name_category }}</td>
                                    <td class="border-bottom-0">{{ $product->stock_product }}</td>
                                    <td class="border-bottom-0">
                                        @if ($product->image_product)
                                            <!-- Menampilkan gambar pertama dari relasi gambar produk -->
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                class="rounded-t-lg w-full h-48 object-cover" alt="Gambar Produk">
                                        @else
                                            <!-- Jika tidak ada gambar terkait dengan produk -->
                                            <p class="text-center text-gray-500">Tidak ada gambar</p>
                                        @endif
            
            
                                    </td>
                                    <td class="border-bottom-0">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editmodal_{{ $product->id }}"
                                            onclick="openEditModal('{{ $product->id }}')">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        <div class="modal fade" id="editmodal_{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="padding: 20px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="max-height: 80vh; overflow-y: auto; padding: 20px;">
                                                        <!-- Form inside modal -->
                                                        <form action="{{ route('admin.products.update', $product->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
            
                                                            <!-- Baris Pertama: Nama Produk dan Kategori -->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="name_product" class="form-label">Nama Produk</label>
                                                                        <input type="text" name="name_product" class="form-control"
                                                                            id="name_product"
                                                                            value="{{ old('name_product') ?? $product->name_product }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="category_id" class="form-label">Kategori</label>
                                                                        <select name="category_id" class="form-control" id="category_id"
                                                                            required>
                                                                            <option value="">Pilih Kategori</option>
                                                                            @foreach ($categories as $category)
                                                                                <option value="{{ $category->id }}"
                                                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                                    {{ $category->name_category }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
            
                                                            <!-- Baris Kedua: Stok dan Harga -->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="stock_product" class="form-label">Stok
                                                                            Produk</label>
                                                                        <input type="number" name="stock_product" class="form-control"
                                                                            id="stock_product"
                                                                            value="{{ old('stock_product') ?? $product->stock_product }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="price_product" class="form-label">Harga
                                                                            Produk</label>
                                                                        <input type="number" name="price_product" class="form-control"
                                                                            id="price_product"
                                                                            value="{{ old('price_product') ?? $product->price_product }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
            
                                                            <!-- Baris Ketiga: Deskripsi Produk -->
                                                            <div class="mb-3">
                                                                <label for="description_product" class="form-label">Deskripsi
                                                                    Produk</label>
                                                                <textarea name="description_product" class="form-control" id="description_product" rows="5" required>{{ old('description_product') ?? $product->description_product }}</textarea>
                                                            </div>
            
                                                            <!-- Baris Keempat: Gambar Produk -->
                                                            <div class="mb-3">
                                                                <label for="image_product" class="form-label">Gambar Produk</label>
                                                                <input type="file" name="image_product" class="form-control"
                                                                    id="image_product" accept="image/*">
                                                                <span class="text-[#25d162] text-sm text-center my-4 block">Biarkan
                                                                    kosong jika tidak ingin mengubah gambar.</span>
            
                                                                @if ($product->image_product)
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset('storage/' . $product->image_product) }}"
                                                                            alt="Gambar Produk" class="img-thumbnail"
                                                                            style="max-width: 150px;">
                                                                    </div>
                                                                @endif
            
                                                                @error('gambar')
                                                                    <div
                                                                        class="bg-red-100 border text-center border-red-500 text-red-700 text-sm p-2 rounded-md mt-1">
                                                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
            
            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                                                            </div>
            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" name="name_product" class="form-control" id="name_product"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" class="form-control" id="description_product" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price_product" class="form-label">Harga Produk</label>
                            <input type="number" name="price_product" class="form-control" id="price_product"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="stock_product" class="form-label">Stok Produk</label>
                            <input type="number" name="stock_product" class="form-control" id="stock_product"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" class="form-control" id="image_product"
                                accept="image/*">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
