@extends('layouts.user')

@section('main')
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse ml-[-30px]">
            <li class="flex items-center">
                <a href="{{ route('landing-page') }}"
                    class="flex justify-center  items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-1.5 px-2 rounded-md">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                        </g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6.49996 7C7.96131 5.53865 9.5935 4.41899 10.6975 3.74088C11.5021 3.24665 12.4978 3.24665 13.3024 3.74088C14.4064 4.41899 16.0386 5.53865 17.5 7C20.6683 10.1684 20.5 12 20.5 15C20.5 16.4098 20.3895 17.5988 20.2725 18.4632C20.1493 19.3726 19.3561 20 18.4384 20H17C15.8954 20 15 19.1046 15 18V16C15 15.2043 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87864 13.8787C9.31603 14.4413 8.99996 15.2043 8.99996 16V18C8.99996 19.1046 8.10453 20 6.99996 20H5.56152C4.64378 20 3.85061 19.3726 3.72745 18.4631C3.61039 17.5988 3.49997 16.4098 3.49997 15C3.49997 12 3.33157 10.1684 6.49996 7Z"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span class="font-semibold text-xs"> Beranda</span>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class=" h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="m9 5 7 7-7 7" />
                    </svg>
                    <a href="{{ route('page.product') }}"
                        class="flex justify-center ml-2 items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-2 px-2 rounded-md">
                        <span class="font-semibold text-xs">Produk</span>
                    </a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex justify-between items-center bg-white py-3 px-4 rounded-lg mb-1 shadow-sm">
        <h2 class="flex text-xl justify-center font-semibold text-gray-800 ">Alamat Saya </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
            + Tambah Alamat
        </button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm">
        @forelse ($addresses as $address)
            <div class="w-full flex flex-col space-y-6">
                <!-- Section Alamat -->
                <div
                    class="flex flex-col md:flex-row md:justify-between md:items-center p-4 border rounded-lg shadow-sm bg-gray-50 space-y-4 md:space-y-0">
                    <!-- Informasi Kontak dan Alamat -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <p class="font-bold text-gray-800">{{ $address->user->name }}</p>
                            <p class="text-gray-500">|</p>
                            <p class="text-gray-600">{{ $address->no_telepon }}</p>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">
                            {{ $address->address }} , {{ $address->city['city_name'] }}
                        </p>
                        <div
                            class="inline-block px-3 py-1 border-1 border-blue-500 text-blue-500 text-xs font-semibold rounded-lg">
                            {{ $address->mark }}
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div
                        class="flex gap-2 xl:flex-col md:flex-col sm:flex-row justify-between md:items-end sm:space-x-2 md:space-x-0 md:space-y-2">
                        <!-- Tombol Edit -->
                        <button type="button"
                            class="btn btn-warning btn-sm w-full text-white font-semibold sm:flex-1 text-center"
                            data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">
                            Edit
                        </button>
                        <!-- Form untuk menghapus alamat -->
                        <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST"
                            class="w-full sm:flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm w-full text-white font-semibold sm:flex-1 text-center"
                                onclick="return confirm('Yakin ingin menghapus?')">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Garis Pembatas -->
                <hr class="bg-gray-100 w-[98%] h-[2px] mb-4">
            </div>
            <div class="modal fade {{ old('address_id') == $address->id ? 'show' : '' }}"
                id="editAddressModal{{ $address->id }}" tabindex="-1"
                aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true"
                style="{{ old('address_id') == $address->id ? 'display: block;' : '' }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">Edit Alamat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.addresses.update', $address->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="address_id" value="{{ $address->id }}">
                                <div class="mb-3">
                                    <label for="mark">Tandai Sebagai</label>
                                    <input type="text" name="mark" id="mark" class="form-control"
                                        placeholder="cth rumah/kantor/gedung/dll" value="{{ $address->mark }}">
                                    @if (old('address_id') == $address->id)
                                        @error('mark')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="city_id">Kota</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value="">Pilih Kota</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city['city_id'] }}"
                                                {{ $address->city_id == $city['city_id'] ? 'selected' : '' }}>
                                                {{ $city['city_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (old('address_id') == $address->id)
                                        @error('city_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" class="form-control" rows="3">{{ $address->address }}</textarea>
                                    @if (old('address_id') == $address->id)
                                        @error('address')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                        value="{{ $address->no_telepon }}">
                                    @if (old('address_id') == $address->id)
                                        @error('no_telepon')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class=" rounded-lg p-4 text-center flex flex-col justify-center items-center">
                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan" class="w-64 h-64">
                <p class="text-lg text-gray-600 font-medium">Alamat Kosong</p>
            </div>
        @endforelse

    </div>

    </div>

    <!-- Modal Tambah Alamat -->

    <div class="modal fade {{ old('address_id') ? '' : ($errors->any() ? 'show' : '') }}" id="addAddressModal"
        tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true"
        style="{{ old('address_id') ? '' : ($errors->any() ? 'display: block;' : '') }}">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Tambah Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.addresses.store') }}" method="POST">
                        @csrf
                        <!-- Tandai Sebagai -->
                        <div class="mb-3">
                            <label for="mark">Tandai Sebagai</label>
                            <input type="text" name="mark" id="mark" class="form-control"
                                placeholder="cth rumah/kantor/gedung/dll" value="{{ !old('address_id') ? old('mark') : '' }}">
                            @if (!old('address_id'))
                                @error('mark')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Kota -->
                        <div class="mb-3">
                            <label for="city_id">Kota</label>
                            <select name="city_id" id="city_id" class="form-control" value="{{ !old('address_id') ? old('city_id') : '' }}">
                                <option value="">Pilih Kota</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city['city_id'] }}">
                                        {{ $city['city_name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @if (!old('address_id'))
                                @error('city_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Alamat" value="{{ !old('address_id') ? old('address') : '' }}"></textarea>
                            @if (!old('address_id'))
                                @error('address')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- No Telepon -->
                        <div class="mb-3">
                            <label for="no_telepon">No Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                placeholder="080-000-000-000" value="{{ !old('address_id') ? old('no_telepon') : '' }}">
                            @if (!old('address_id'))
                                @error('no_telepon')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (old('address_id'))
                    // Jika terdapat error pada modal edit
                    var editModalId = 'editAddressModal{{ old('address_id') }}';
                    var editAddressModal = new bootstrap.Modal(document.getElementById(editModalId));
                    editModal.show();
                @else
                    // Jika terdapat error pada modal tambah
                    var tambahModal = new bootstrap.Modal(document.getElementById('ddAddressModal'));
                    AddAddressModal.show();
                @endif
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            // Toast Notification
            Swal.fire({
                toast: true,
                position: 'top-end', // Pojok kanan atas
                icon: 'success',
                iconColor: '#3b82f6', // Biru-500 dari Tailwind CSS
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#eff6ff', // Warna latar belakang biru muda
            });
        </script>
    @endif



    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Ketika ada perubahan pada select kota
            $('#city_id').on('change', function() {
                let city_id = $(this).val(); // Ambil city_id yang dipilih

                if (!city_id) {
                    // Jika tidak ada kota yang dipilih, reset select kota
                    return;
                }

                // Tidak perlu melakukan ajax, karena tidak ada provinsi yang dipilih
            });
        </script>
    @endpush

    <!-- Script untuk Menampilkan Modal Jika Ada Error -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (old('address_id'))
                    // Jika terdapat error pada modal edit
                    var editModalId = 'editAddressModal' + '{{ old('address_id') }}';
                    var editModal = new bootstrap.Modal(document.getElementById(editModalId));
                    editModal.show();
                @else
                    // Jika terdapat error pada modal tambah
                    var addModal = new bootstrap.Modal(document.getElementById('addAddressModal'));
                    addModal.show();
                @endif
            });
        </script>
    @endif
@endsection
