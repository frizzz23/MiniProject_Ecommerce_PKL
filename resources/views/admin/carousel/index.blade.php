@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="flex flex-col md:flex-row mb-4 gap-4">
                <!-- Banner -->
                <div class="w-full md:w-3/4 bg-blue-500 bg-opacity-20 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Judul dan Breadcrumb -->
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Carousel</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.carousel.index') }}"
                                            class="hover:text-blue-500">Carousel</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/list.png') }}" alt="Gambar Banner"
                                class="w-32 h-32 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-t from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">
                            <i class="fa-regular fa-images text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Carousel</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $carousel->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card w-full">
                <div class="card-body p-4">
                    <div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.carousel.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari carousel"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahmodal">
                                    + Tambah Carousel
                                </button>
                                <!-- Filter Sort By Date -->
                                <form id="filterForm" action="{{ route('admin.carousel.index') }}" method="GET"
                                    class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <select name="sort_order"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            onchange="this.form.submit();" id="sort_order">
                                            <option value="">Urutkan</option>
                                            <option value="terlama"
                                                {{ request('sort_order') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                            <option value="terbaru"
                                                {{ request('sort_order') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white">
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Judul</th>
                                    <th class="px-4 py-2 text-left">Gambar Desktop</th>
                                    <th class="px-4 py-2 text-left">Gambar Tablet</th>
                                    <th class="px-4 py-2 text-left">Gambar Mobile</th>
                                    <th class="px-4 py-2 text-left">Dibuat</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carousel as $item)
                                    <tr class="hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $item->title }}</td>
                                        <td class="px-4 py-2">
                                            <img src="{{ asset('storage/' . $item->desktop_image) }}" alt="Desktop"
                                                class="w-28 h-28 object-cover">
                                        </td>
                                        <td class="px-4 py-2">
                                            <img src="{{ asset('storage/' . $item->tablet_image) }}" alt="Tablet"
                                                class="w-28 h-28 object-cover">
                                        </td>
                                        <td class="px-4 py-2">
                                            <img src="{{ asset('storage/' . $item->mobile_image) }}" alt="Mobile"
                                                class="w-28 h-28 object-cover">
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $item->created_at->format('d F Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="bg-yellow-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-yellow-600"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $item->id }}">
                                                        <i class="fas fa-pen text-sm"></i>
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
                                                        class="bg-red-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-red-600"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusmodal{{ $item->id }}">
                                                        <i class="fas fa-trash text-sm"></i>
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
                                    <div class="modal fade" id="hapusmodal{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.carousel.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus carousel
                                                        <strong>{{ $item->title }}</strong>?
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

                                    <!-- Modal Edit -->
                                    <div class="modal fade {{ $errors->any() && old('carousel_id') == $item->id ? 'show' : '' }}"
                                        id="editmodal{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                        style="{{ $errors->any() && old('carousel_id') == $item->id ? 'display: block;' : '' }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.carousel.update', $item->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="carousel_id"
                                                        value="{{ $item->id }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Carousel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Judul
                                                                Carousel</label>
                                                            <input type="text" name="title" class="form-control"
                                                                value="{{ $item->title }}">
                                                            @if (old('carousel_id') == $item->id)
                                                                @error('title')
                                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="desktop_image" class="form-label">Gambar
                                                                Desktop</label>
                                                            <input type="file" name="desktop_image"
                                                                class="form-control">
                                                            @if (old('carousel_id') == $item->id)
                                                                @error('desktop_image')
                                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tablet_image" class="form-label">Gambar
                                                                Tablet</label>
                                                            <input type="file" name="tablet_image"
                                                                class="form-control">
                                                            @if (old('carousel_id') == $item->id)
                                                                @error('tablet_image')
                                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="mobile_image" class="form-label">Gambar
                                                                Mobile</label>
                                                            <input type="file" name="mobile_image"
                                                                class="form-control">
                                                            @if (old('carousel_id') == $item->id)
                                                                @error('mobile_image')
                                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            @endif
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="h-64">
                                            <div
                                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/empty-data.png') }}" alt="Tidak Ditemukan"
                                                    class="w-64 h-64">
                                                <p class="text-lg text-gray-600 font-medium">Tidak ada Carousel</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Carousel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Carousel</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ !old('carousel_id') ? old('title') : '' }}">
                                @if (!old('carousel_id'))
                                    @error('title')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="desktop_image" class="form-label">Gambar Desktop</label>
                                <input type="file" name="desktop_image" class="form-control" accept="image/*">
                                <small class="text-muted">Ukuran gambar 1920x600 px.</small>
                                @if (!old('carousel_id'))
                                    @error('desktop_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="tablet_image" class="form-label">Gambar Tablet</label>
                                <input type="file" name="tablet_image" class="form-control" accept="image/*">
                                <small class="text-muted">Ukuran gambar 1280x500 px.</small>
                                @if (!old('carousel_id'))
                                    @error('tablet_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="mobile_image" class="form-label">Gambar Mobile</label>
                                <input type="file" name="mobile_image" class="form-control" accept="image/*">
                                <small class="text-muted">Ukuran gambar 768x400 px.</small>
                                @if (!old('carousel_id'))
                                    @error('mobile_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check for validation errors
            const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
            const carouselId = '{{ old('carousel_id') }}';

            if (hasErrors) {
                // Close any open modals first
                const openModals = document.querySelectorAll('.modal.show');
                openModals.forEach(modal => {
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                });

                // Determine which modal to show
                if (carouselId) {
                    // Show edit modal if carousel_id exists
                    const editModal = document.getElementById(`editmodal${carouselId}`);
                    if (editModal) {
                        const bsEditModal = new bootstrap.Modal(editModal);
                        bsEditModal.show();
                    }
                } else {
                    // Show add modal if no carousel_id
                    const tambahModal = document.getElementById('tambahmodal');
                    if (tambahModal) {
                        const bsTambahModal = new bootstrap.Modal(tambahModal);
                        bsTambahModal.show();
                    }
                }
            }
        });
    </script>
@endsection
