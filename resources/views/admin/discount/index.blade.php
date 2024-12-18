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
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Voucher</h5>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahmodal">
                                    + Tambah Vocher
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
                                        <option value="1" {{ request('stock_product') == '1' ? 'selected' : '' }}>
                                            Ada
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
                                    <th class="px-4 py-2 text-left" style="width: 5%;">No</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">Kode Vocher</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Diskon</th>
                                    <th class="px-4 py-2 text-left" style="width: 10%;">Kuantitas</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">Minimal Pembelian</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Pengguna</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($codes as $code)
                                    <tr class="hover:bg-gray-100  border-b">
                                        <td class="px-4 py-2">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $code->code }}
                                        </td>
                                        <td class="px-4 py-2">
                                            Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $code->quantity }}
                                        <td class="px-4 py-2">
                                            Rp. {{ number_format($code->minimum_purchase, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            @if ($code->users->count() > 0)
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#usermodal{{ $code->id }}">
                                                    Lihat Pengguna
                                                </button>
                                            @else
                                                Belum digunakan
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editmodal{{ $code->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#hapusmodal{{ $code->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="usermodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="userModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="userModalLabel{{ $code->id }}">
                                                        Pengguna Yang Sudah Menggunakan Voucher {{ $code->code }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="color: black;">
                                                    @if ($code->users->count() > 0)
                                                        <ul>
                                                            @foreach ($code->users as $user)
                                                                <li><strong>Nama:</strong>{{ $user->name }} <br>
                                                                    <strong>Email:</strong> ({{ $user->email }})
                                                                    <br> <br>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Belum ada pengguna yang memakai voucher ini.</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel{{ $code->id }}">
                                                        Hapus Vocher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="color: black;">
                                                    Apakah Anda yakin ingin menghapus voucher
                                                    <strong>{{ $code->code }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                                                        Edit Vocher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.discount.update', $code->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="code{{ $code->id }}"
                                                                class="form-label">Kode Vocher</label>
                                                            <input type="text" name="code" class="form-control"
                                                                value="{{ old('code') ?? $code->code }}"
                                                                id="code{{ $code->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="discount_amount{{ $code->id }}"
                                                                class="form-label">Jumlah Diskon</label>
                                                            <input type="number" name="discount_amount"
                                                                class="form-control"
                                                                value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                                                id="discount_amount{{ $code->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity{{ $code->id }}"
                                                                class="form-label">Kuantitas</label>
                                                            <input type="number" name="quantity"
                                                                class="form-control"
                                                                value="{{ old('quantity') ?? $code->quantity }}"
                                                                id="quantity{{ $code->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="minimum_purchase{{ $code->id }}"
                                                                class="form-label">Minimal Pembelian</label>
                                                            <input type="number" name="minimum_purchase"
                                                                class="form-control"
                                                                value="{{ old('minimum_purchase') ?? $code->minimum_purchase }}"
                                                                id="minimum_purchase{{ $code->id }}" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
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
                    <h5 class="modal-title" id="formModalLabel">Tambah Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.discount.store') }}" method="POST">
                        @csrf

                        <!-- Kode Voucher -->
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Voucher</label>
                            <input type="text" name="code" class="form-control" id="code"
                                value="{{ old('code') }}">
                            @error('code')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jumlah Diskon -->
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" class="form-control" id="discount_amount"
                                value="{{ old('discount_amount') }}">
                            @error('discount_amount')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kuantitas -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Minimal Pembelian -->
                        <div class="mb-3">
                            <label for="minimum_purchase" class="form-label">Minimal Pembelian</label>
                            <input type="number" name="minimum_purchase" class="form-control" id="minimum_purchase"
                                value="{{ old('minimum_purchase') }}">
                            @error('minimum_purchase')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

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


{{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif



        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Vocher</th>
                    <th>Diskon</th>
                    <th>Kuantitas</th>
                    <th>Minimal Pembelian</th>
                    <th>Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($codes as $code)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $code->code }}</td>
                        <td>Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}</td>
                        <td>{{ $code->quantity }}</td>
                        <td>Rp. {{ number_format($code->minimum_purchase, 0, ',', '.') }}</td>
                        <td>
                            @if ($code->users->count() > 0)
                                <button type="button" class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#usermodal{{ $code->id }}">
                                    Lihat Pengguna
                                </button>
                            @else
                                Belum digunakan
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editmodal{{ $code->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusmodal{{ $code->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Lihat Pengguna -->
                    <div class="modal fade" id="usermodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="userModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $code->id }}">
                                        Pengguna Yang Sudah Menggunakan Voucher {{ $code->code }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: black;">
                                    @if ($code->users->count() > 0)
                                        <ul>
                                            @foreach ($code->users as $user)
                                                <li><strong>Nama:</strong>{{ $user->name }} <br>
                                                    <strong>Email:</strong> ({{ $user->email }})
                                                    <br> <br>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Belum ada pengguna yang memakai voucher ini.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusmodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="hapusModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel{{ $code->id }}">
                                        Hapus Vocher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: black;">
                                    Apakah Anda yakin ingin menghapus voucher
                                    <strong>{{ $code->code }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editmodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                                        Edit Vocher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.discount.update', $code->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="code{{ $code->id }}"
                                                class="form-label">Kode Vocher</label>
                                            <input type="text" name="code" class="form-control"
                                                value="{{ old('code') ?? $code->code }}"
                                                id="code{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="discount_amount{{ $code->id }}"
                                                class="form-label">Jumlah Diskon</label>
                                            <input type="number" name="discount_amount"
                                                class="form-control"
                                                value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                                id="discount_amount{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity{{ $code->id }}"
                                                class="form-label">Kuantitas</label>
                                            <input type="number" name="quantity"
                                                class="form-control"
                                                value="{{ old('quantity') ?? $code->quantity }}"
                                                id="quantity{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="minimum_purchase{{ $code->id }}"
                                                class="form-label">Minimal Pembelian</label>
                                            <input type="number" name="minimum_purchase"
                                                class="form-control"
                                                value="{{ old('minimum_purchase') ?? $code->minimum_purchase }}"
                                                id="minimum_purchase{{ $code->id }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Kembali</button>
                                            <button type="submit" class="btn btn-primary">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
