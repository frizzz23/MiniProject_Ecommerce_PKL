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
            
                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Kategori</h5>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.categories.index') }}" method="GET" class="d-inline-block">
                                    <input type="hidden" name="sort_by_date" value="{{ request('sort_by_date') }}">
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
                                <!-- Filter Sort By Date -->
                                <form id="filterForm" action="{{ route('admin.categories.index') }}" method="GET"
                                    class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <select name="sort_order"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            onchange="this.form.submit();" id="sort_order">
                                            <option value="">Urutkan</option>
                                            <option value="terlama"
                                                {{ request('sort_order') == 'terlama' ? 'selected' : '' }}>
                                                Terlama</option>
                                            <option value="terbaru"
                                                {{ request('sort_order') == 'terbaru' ? 'selected' : '' }}>
                                                Terbaru</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Gambar</th>
                                    <th class="px-4 py-2 text-left">Nama Kategori</th>
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
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm px-3 py-1.5 text-white bg-yellow-500 hover:bg-yellow-600 rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $category->id }}">
                                                        <svg xmlns="http://www.w3.org/2000 ```blade
                                                        .svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M17.414 2.586a2 2 0 00-2.828 0L8 9.172 7 13l3.828-1L17.414 5.414a2 2 0 000-2.828l-1-1zM15 4l1-1L15 2l-1 1 1 1zM4 13v3h3l9-9-3-3L4 13z" />
                                                        </svg>
                                                    </button>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                        Edit
                                                    </span>
                                                </div>

                                                <!-- Delete Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm px-3 py-1.5 text-white bg-red-500 hover:bg-red-600 rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusmodal{{ $category->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M6 4a1 1 0 000 2h8a1 1 0 100-2H6zM3 6a1 1 0 011-1h12a1 1 0 011 1v11a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 9a1 1 0 102 0V8a1 1 0 00-2 0v7zm5-1a1 1 0 10-2 0V8a1 1 0 112 0v6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    </button>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                        Hapus
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $category->id }}" tabindex="-1"
                                        aria-hidden ```blade
="true">
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

<!-- Modal Edit -->
@foreach ($categories as $category)
<div class="modal fade {{ $errors->any() && old('category_id') == $category->id ? 'show' : '' }}"
     id="editmodal{{ $category->id }}"
     tabindex="-1"
     aria-hidden="true"
     style="{{ $errors->any() && old('category_id') == $category->id ? 'display: block;' : '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name_category_{{ $category->id }}" class="form-label">Nama Kategori</label>
                        <input type="text" name="name_category" class="form-control"  value="{{ $category->name_category }}" >
                        @if (old('category_id') == $category->id)
                            @error('name_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit_name_category" class="form-label">Nama Kategori</label>
                        <input type="text" name="name_category" class="form-control"
                               value="{{ old('category_id') == $category->id ? old('name_category') : $category->name_category }}">
                        @error('name_category')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="edit_image_category" class="form-label">Gambar</label>
                        <input type="file" name="image_category" class="form-control">
                        <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah -->
<div class="modal fade {{ $errors->any() && !old('category_id') ? 'show' : '' }}"
     id="tambahmodal"
     tabindex="-1"
     aria-hidden="true"
     style="{{ $errors->any() && !old('category_id') ? 'display: block;' : '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
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
                        @if (!old('category_id'))
                            @error('name_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        @endif
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
        @if (old('category_id'))
            // Jika terdapat error pada modal edit
            var editModalId = 'editmodal{{ old('category_id') }}';
            var editModal = new bootstrap.Modal(document.getElementById(editModalId));
            editModal.show();
        @else
            // Jika terdapat error pada modal tambah
            var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
            tambahModal.show();
        @endif
    });
</script>
@endif



@endsection
