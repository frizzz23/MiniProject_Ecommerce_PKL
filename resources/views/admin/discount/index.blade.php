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
                            </div>
                        </div>
                        <form action="{{ route('admin.discount.index') }}" method="GET">
                            <div class="grid grid-cols-3 gap-3 text-white border-t border-gray-600 pt-4 mb-4">
                                <div>
                                    <select name="price_discount"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Diskon</option>
                                        <option value="asc" {{ request('price_discount') == 'asc' ? 'selected' : '' }}>
                                            Terendah ke Tertinggi</option>
                                        <option value="desc" {{ request('price_discount') == 'desc' ? 'selected' : '' }}>
                                            Tertinggi ke Terendah</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="kuantitas"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Kuantitas</option>
                                        <option value="asc" {{ request('kuantitas') == 'asc' ? 'selected' : '' }}>
                                            Sedikit Ke Terbanyak</option>
                                        <option value="desc" {{ request('kuantitas') == 'desc' ? 'selected' : '' }}>
                                            Terbanyak Ke Sedikit</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="minimal_pembelian"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Minimal Pembelian</option>
                                        <option value="asc"
                                            {{ request('minimal_pembelian') == 'asc' ? 'selected' : '' }}>
                                            Terendah ke Tertinggi</option>
                                        <option value="desc"
                                            {{ request('minimal_pembelian') == 'desc' ? 'selected' : '' }}>
                                            Tertinggi ke Terendah</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
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
                                        <td class="px-6 py-5">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-6 py-5">
                                            {{ $code->code }}
                                        </td>
                                        <td class="px-6 py-5">
                                            Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            {{ $code->quantity }}
                                        <td class="px-6 py-5">
                                            Rp. {{ number_format($code->minimum_purchase, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
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
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm px-3 py-1.5 text-white bg-yellow-500 hover:bg-yellow-600 rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $code->id }}">
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
                                                        data-bs-target="#hapusmodal{{ $code->id }}">
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
                                    <div class="modal fade" id="usermodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="userModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <!-- Banner Section -->
                                                <div class="p-4">
                                                    <div class="relative ">
                                                        <!-- Banner Image -->
                                                        <img src="{{ asset('img/voucher.jpg') }}" alt="Voucher Banner"
                                                            class=" w-full h-[150px] rounded-md">
                                                        <!-- Text Overlay -->
                                                        <div
                                                            class="absolute top-0 left-0 right-0 bottom-0 flex flex-col justify-center items-center text-white">
                                                            <!-- Title Text with smaller font size -->
                                                            <p class="text-xl font-bold mb-2 border-b-2 border-white ">Kode
                                                                Voucher</p> <!-- Title size adjusted -->

                                                            <!-- Description Text with underline and dark blue color -->
                                                            <p class="text-3xl font-bold  text-blue-700">
                                                                ({{ $code->code }})</p>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="title w-full flex justify-center items-center">
                                                        <p class="text-xl font-bold mb-2"><span class="text-blue-400 ">Pengguna</span> kode voucher</p>
                                                    </div>
                                                    @if ($code->users->count() > 0)
                                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-3 max-h-96 overflow-y-auto">
                                                            @foreach ($code->users as $user)
                                                                <div class="flex items-center p-3 border rounded-lg shadow-sm bg-gray-50">
                                                                    <!-- User Avatar -->
                                                                    @if ($user->image)
                                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                                             alt="Profile Picture"
                                                                             class="rounded-full w-16 h-16 mr-4">
                                                                    @else
                                                                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                                                             alt="User Avatar"
                                                                             class="rounded-full w-14 h-14 mr-4">
                                                                    @endif
                                                                    <!-- User Details -->
                                                                    <div>
                                                                        <h6 class="font-bold text-lg mb-1">
                                                                            {{ $user->name }}</h6>
                                                                        <p class="text-sm text-gray-600 mb-1">
                                                                            <strong>Email:</strong> {{ $user->email }}
                                                                        </p>
                                                                        <p class="text-sm text-gray-600">
                                                                            <strong>Waktu Klaim:</strong>
                                                                            {{ $user->pivot->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="text-center py-5">
                                                            <img src="https://via.placeholder.com/150x100?text=No+Users"
                                                                 alt="No Users" class="mx-auto mb-4">
                                                            <p class="text-gray-600">Tidak ada pengguna yang menggunakan voucher ini.</p>
                                                        </div>
                                                    @endif
                                                </div>



                                                <!-- Footer -->
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
                                    <div class="modal fade {{ $errors->any() && old('code_id') == $code->id ? 'show' : '' }}"
                                        id="editmodal{{ $code->id }}" tabindex="-1" aria-hidden="true"
                                        style="{{ $errors->any() && old('code_id') == $code->id ? 'display: block;' : '' }}">
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
                                                        <input type="hidden" name="code_id" value="{{ $code->id }}">
                                                        <div class="mb-3">
                                                            <label for="code{{ $code->id }}" class="form-label">Kode
                                                                Vocher</label>
                                                            <input type="text" name="code" class="form-control"
                                                               value="{{$code->code}}"
                                                                id="code{{ $code->id }}">
                                                                @if (old('code_id') == $code->id)
                                                                    @error('code')
                                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="discount_amount{{ $code->id }}"
                                                                class="form-label">Jumlah Diskon</label>
                                                            <input type="number" name="discount_amount"
                                                                class="form-control"
                                                                value="{{$code->discount_amount}}"
                                                                id="discount_amount{{ $code->id }}">
                                                                @if (old('code_id') == $code->id)
                                                                    @error('discount_amount')
                                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity{{ $code->id }}"
                                                                class="form-label">Kuantitas</label>
                                                            <input type="number" name="quantity" class="form-control"
                                                                value="{{$code->quantity}}"
                                                                id="quantity{{ $code->id }}">
                                                                @if (old('code_id') == $code->id)
                                                                    @error('quantity')
                                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="minimum_purchase{{ $code->id }}"
                                                                class="form-label">Minimal Pembelian</label>
                                                            <input type="number" name="minimum_purchase"
                                                                class="form-control"
                                                                value="{{$code->minimum_purchase}}"
                                                                id="minimum_purchase{{ $code->id }}">
                                                                @if (old('code_id') == $code->id)
                                                                    @error('minimum_purchase')
                                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                @endif
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
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $codes->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($codes as $code )
    <div class="modal fade {{ $errors->any() && old('code_id') == $code->id ? 'show' : '' }}"
        id="editmodal{{ $code->id }}"
        tabindex="-1"
        aria-hidden="true"
        style="{{ $errors->any() && old('code_id') == $code->id ? 'display: block;' : '' }}">
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
                        <input type="hidden" name="code_id" value="{{ $code->id }}">
                        <div class="mb-3">
                            <label for="code{{ $code->id }}" class="form-label">Kode
                                Vocher</label>
                            <input type="text" name="code" class="form-control"
                                value="{{ old('code') ?? $code->code }}"
                                id="code{{ $code->id }}">
                                @error('code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount_amount{{ $code->id }}"
                                class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount"
                                class="form-control"
                                value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                id="discount_amount{{ $code->id }}">
                                @error('discount_amount')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity{{ $code->id }}"
                                class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control"
                                value="{{ old('quantity') ?? $code->quantity }}"
                                id="quantity{{ $code->id }}">
                                @error('quantity')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="minimum_purchase{{ $code->id }}"
                                class="form-label">Minimal Pembelian</label>
                            <input type="number" name="minimum_purchase"
                                class="form-control"
                                value="{{ old('minimum_purchase') ?? $code->minimum_purchase }}"
                                id="minimum_purchase{{ $code->id }}">
                                @error('minimum_purchase')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
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

    <!-- Modal Tambah -->
    <div class="modal fade {{ $errors->any() && !old('code_id') ? 'show' : '' }}"
        id="tambahmodal"
        tabindex="-1"
        aria-hidden="true"
        style="{{ $errors->any() && !old('code_id') ? 'display: block;' : '' }}">
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
                            @if (!old('code_id'))
                                @error('code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Jumlah Diskon -->
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" class="form-control" id="discount_amount"
                                value="{{ old('discount_amount') }}">
                            @if (!old('code_id'))
                                @error('discount_amount')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Kuantitas -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                value="{{ old('quantity') }}">
                            @if (!old('code_id'))
                                @error('quantity')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Minimal Pembelian -->
                        <div class="mb-3">
                            <label for="minimum_purchase" class="form-label">Minimal Pembelian</label>
                            <input type="number" name="minimum_purchase" class="form-control" id="minimum_purchase"
                                value="{{ old('minimum_purchase') }}">
                            @if (!old('code_id'))
                                @error('minimum_purchase')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
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
            @if (old('code_id'))
                // Jika terdapat error pada modal edit
                var editModalId = 'editmodal{{ old('code_id') }}';
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
