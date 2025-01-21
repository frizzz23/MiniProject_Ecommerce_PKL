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
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Ulasan</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.reviews.index') }}" class="hover:text-blue-500"> Ulasan</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/ulasan.png') }}" alt="Gambar Banner"
                                class="w-44 h-44 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-r from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">
                            <i class="fa-solid fa-comments text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Ulasan</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $reviews->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-full">
                
                <div class="card-body p-4">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <!-- Pencarian -->
                            <form action="{{ route('admin.reviews.index') }}" method="GET" class="d-inline-block">
                                <div class="d-flex align-items-center">
                                    <input type="text" name="search" class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk atau komentar"
                                        value="{{ request('search') }}" style="width: 200px;">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- Filter Form -->
                    <form action="{{ route('admin.reviews.index') }}" method="GET" id="filterForm">
                        <div class="grid grid-cols-3 gap-4 text-white border-t border-gray-600 pt-4 mb-4">
                            <!-- Filter Produk -->
                            <div>
                                <select name="product_id" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Semua Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name_product }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Rating -->
                            <div>
                                <select name="rating" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Rating</option>
                                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                                </select>
                            </div>

                            <!-- Filter Tanggal -->
                            <div>
                                <select name="created_at" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Tanggal</option>
                                    <option value="asc" {{ request('created_at') == 'asc' ? 'selected' : '' }}>Lama</option>
                                    <option value="desc" {{ request('created_at') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white">
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Pengguna</th>
                                    <th class="px-4 py-2 text-left">Produk</th>
                                    <th class="px-4 py-2 text-left">Rating</th>
                                    <th class="px-4 py-2 text-left">Komentar</th>
                                    <th class="px-4 py-2 text-left">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr class="hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $loop->iteration ?? '-' }}</td>
                                        <td class="px-4 py-2 flex items-center">{{ $review->user->name }}</td>
                                        <td class="px-4 py-2">{{ $review->product->name_product }}</td>
                                        <td class="px-4 py-2">{{ $review->rating }}</td>
                                        <td class="px-4 py-2">{{ $review->comment }}</td>
                                        <td class="px-4 py-2">{{ $review->created_at->format('d F Y') ?? 'kosong' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada review yang ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $reviews->links() }}
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection


{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
        + Tambah Ulasan
    </button>
    <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">No</th>
                    <th class="border-bottom-0">Pengguna</th>
                    <th class="border-bottom-0">Produk</th>
                    <th class="border-bottom-0">Rating</th>
                    <th class="border-bottom-0">Komentar</th>
                    <th class="border-bottom-0">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                        <td class="border-bottom-0">{{ $review->user->name }}</td>
                        <td class="border-bottom-0">{{ $review->product->name_product }}</td>
                        <td class="border-bottom-0">{{ $review->rating }}</td>
                        <td class="border-bottom-0">{{ $review->comment }}</td>
                        <td class="border-bottom-0">
                            <!-- Button untuk membuka modal edit ulasan -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editReviewModal{{ $review->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Ulasan -->
                    <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1"
                        aria-labelledby="editReviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editReviewModalLabel">Edit Ulasan untuk
                                        Produk: {{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('admin.reviews.update', ['review' => $review->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Produk Dropdown -->
                                        <div class="mb-3">
                                            <label for="product_id">Produk</label>
                                            <select name="product_id" id="product_id" class="form-select"
                                                required>
                                                <!-- Menandai produk yang sudah dipilih -->

                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        @if ($product->id == $review->product->id) selected @endif>
                                                        {{ $product->name_product }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Pengguna Dropdown -->
                                        <div class="mb-3">
                                            <label for="user_id">Pengguna</label>
                                            <select name="user_id" id="user_id" class="form-select"
                                                required>
                                                <!-- Menandai pengguna yang sudah dipilih -->

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $review->user->id) selected @endif>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Rating Dropdown -->
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating</label>
                                            <select name="rating" id="rating" class="form-select"
                                                required>
                                                <option value="" disabled>Pilih Rating</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($review->rating == $i) selected @endif>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- Komentar Textarea -->
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Komentar</label>
                                            <textarea name="comment" id="comment" class="form-control" rows="5" required>{{ $review->comment }}</textarea>
                                        </div>

                                        <!-- Submit dan Close -->
                                        <button type="submit" class="btn btn-primary">Simpan
                                            Perubahan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReviewModalLabel">Tambah Ulasan untuk Produk: {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.reviews.store', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id">Produk</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">Pilih produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id">Pengguna</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Pilih pengguna</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="" disabled selected>Pilih Rating</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
