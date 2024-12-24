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
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm px-3 py-1.5 text-white bg-yellow-500 hover:bg-yellow-600 rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $category->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
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
                                                        <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M3 6.38597C3 5.90152 3.34538 5.50879 3.77143 5.50879L6.43567 5.50832C6.96502 5.49306 7.43202 5.11033 7.61214 4.54412C7.61688 4.52923 7.62232 4.51087 7.64185 4.44424L7.75665 4.05256C7.8269 3.81241 7.8881 3.60318 7.97375 3.41617C8.31209 2.67736 8.93808 2.16432 9.66147 2.03297C9.84457 1.99972 10.0385 1.99986 10.2611 2.00002H13.7391C13.9617 1.99986 14.1556 1.99972 14.3387 2.03297C15.0621 2.16432 15.6881 2.67736 16.0264 3.41617C16.1121 3.60318 16.1733 3.81241 16.2435 4.05256L16.3583 4.44424C16.3778 4.51087 16.3833 4.52923 16.388 4.54412C16.5682 5.11033 17.1278 5.49353 17.6571 5.50879H20.2286C20.6546 5.50879 21 5.90152 21 6.38597C21 6.87043 20.6546 7.26316 20.2286 7.26316H3.77143C3.34538 7.26316 3 6.87043 3 6.38597Z"
                                                                    fill="#fff"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M11.5956 22.0001H12.4044C15.1871 22.0001 16.5785 22.0001 17.4831 21.1142C18.3878 20.2283 18.4803 18.7751 18.6654 15.8686L18.9321 11.6807C19.0326 10.1037 19.0828 9.31524 18.6289 8.81558C18.1751 8.31592 17.4087 8.31592 15.876 8.31592H8.12404C6.59127 8.31592 5.82488 8.31592 5.37105 8.81558C4.91722 9.31524 4.96744 10.1037 5.06788 11.6807L5.33459 15.8686C5.5197 18.7751 5.61225 20.2283 6.51689 21.1142C7.42153 22.0001 8.81289 22.0001 11.5956 22.0001ZM10.2463 12.1886C10.2051 11.7548 9.83753 11.4382 9.42537 11.4816C9.01321 11.525 8.71251 11.9119 8.75372 12.3457L9.25372 17.6089C9.29494 18.0427 9.66247 18.3593 10.0746 18.3159C10.4868 18.2725 10.7875 17.8856 10.7463 17.4518L10.2463 12.1886ZM14.5746 11.4816C14.9868 11.525 15.2875 11.9119 15.2463 12.3457L14.7463 17.6089C14.7051 18.0427 14.3375 18.3593 13.9254 18.3159C13.5132 18.2725 13.2125 17.8856 13.2537 17.4518L13.7537 12.1886C13.7949 11.7548 14.1625 11.4382 14.5746 11.4816Z"
                                                                    fill="#fff"></path>
                                                            </g>
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
