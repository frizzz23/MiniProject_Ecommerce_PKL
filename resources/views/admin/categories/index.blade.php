

{{-- @extends('layouts.admin')

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
                    <h5 class="card-title fw-semibold mb-4">Semua Kategori</h5>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                        Tambah kategori
                    </button>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0" style="width: 10%;">No</th>
                                    <th class="border-bottom-0" style="width: 30%;">Gambar</th>
                                    <th class="border-bottom-0" style="width: 30%;">Nama Kategori</th>
                                    <th class="border-bottom-0" style="width: 20%;">Dibuat</th>
                                    <th class="border-bottom-0" style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">
                                            <img src="{{ asset('storage/' . $category->image_category) }}"
                                                alt="Gambar Kategori" class="img-thumbnail"
                                                style="width: 100px; height: auto;">
                                        </td>
                                        <td class="border-bottom-0">{{ $category->name_category }}</td>
                                        <td class="border-bottom-0">{{ $category->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editmodal{{ $category->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusmodal{{ $category->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal{{ $category->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.categories.update', $category->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name_category" class="form-label">Nama
                                                                Kategori</label>
                                                            <input type="text" name="name_category" class="form-control"
                                                                value="{{ $category->name_category }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_image_category"
                                                                class="form-label">Gambar</label>
                                                            <input type="file" name="image_category"
                                                                class="form-control">
                                                            <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
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
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $category->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus kategori
                                                        <strong>{{ $category->name_category }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Nama Kategori -->
                        <div class="mb-3">
                            <label for="name_category" class="form-label">Nama Kategori</label>
                            <input type="text" name="name_category" class="form-control" id="name_category"
                                value="{{ old('name_category') }}">
                            @error('name_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar Kategori -->
                        <div class="mb-3">
                            <label for="image_category" class="form-label">Gambar Kategori</label>
                            <input type="file" name="image_category" class="form-control" id="image_category"
                                accept="image/*">
                            @error('image_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
                tambahModal.show();
            });
        </script>
    @endif
@endsection --}}


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
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Kategori</h5>
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
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#tambahmodal">
                                    + Tambah kategori
                                </button>
                                <!-- Filter Kategori -->
                                <form id="filterForm" action="{{ route('admin.products.index') }}" method="GET">
                                    <div class="d-flex align-items-center ">
                                        <select name="category_id"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            style="width: 200px;"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">Semua Kategori</option>

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
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Gambar</th>
                                    <th class="px-4 py-2 text-left">Nama Katgeori</th>
                                    <th class="px-4 py-2 text-left">Dibuat</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="hover:bg-gray-100  border-b">
                                        <td class="px-4 py-2">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 flex items-center">
                                            <img src="{{ asset('storage/' . $category->image_category) }}"
                                                alt="{{ $category->name_category }}" class="w-28 h-28 rounded-full mr-3">
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $category->name_category ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $category->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editmodal{{ $category->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusmodal{{ $category->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editmodal{{ $category->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.categories.update', $category->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name_category" class="form-label">Nama
                                                                Kategori</label>
                                                            <input type="text" name="name_category"
                                                                class="form-control"
                                                                value="{{ $category->name_category }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_image_category"
                                                                class="form-label">Gambar</label>
                                                            <input type="file" name="image_category"
                                                                class="form-control">
                                                            <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
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
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $category->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus kategori
                                                        <strong>{{ $category->name_category }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Nama Kategori -->
                        <div class="mb-3">
                            <label for="name_category" class="form-label">Nama Kategori</label>
                            <input type="text" name="name_category" class="form-control" id="name_category"
                                value="{{ old('name_category') }}">
                            @error('name_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar Kategori -->
                        <div class="mb-3">
                            <label for="image_category" class="form-label">Gambar Kategori</label>
                            <input type="file" name="image_category" class="form-control" id="image_category"
                                accept="image/*">
                            @error('image_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
                tambahModal.show();
            });
        </script>
    @endif
@endsection

