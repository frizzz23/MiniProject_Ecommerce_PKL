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
    
    <div class="grid grid-cols-1 max-sm:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6 ">
        <div class="bg-white p-4 rounded-lg text-center shadow-sm w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                <circle cx="10.5" cy="19.5" r="1.5"></circle>
                <circle cx="17.5" cy="19.5" r="1.5"></circle>
                <path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path>
                <path
                    d="M17.31 15h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14z">
                </path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-700">Produk dikeranjang</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalKeranjang }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg text-center shadow-sm w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                <circle cx="10.5" cy="19.5" r="1.5"></circle>
                <circle cx="17.5" cy="19.5" r="1.5"></circle>
                <path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path>
                <path
                    d="M6 2C5.447 2 5 2.447 5 3v18c0 .553.447 1 1 1h12c.553 0 1-.447 1-1V3c0-.553-.447-1-1-1H6zm10 2H8v-.5C8 3.224 8.224 3 8.5 3h7c.276 0 .5.224.5.5V4z">
                </path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-700">Total Pesanan</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg text-center shadow-sm w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(102, 110, 241, 1);" class="w-12 h-12 mb-3 inline-block">
                <path
                    d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z">
                </path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-700">Review ditambahkan</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalReviews }}</p>
        </div>
    </div>

    <div class="flex flex-col justify-center items-start bg-white py-3 px-4 rounded-lg mb-1 shadow-sm">
        <h2 class=" text-xl font-semibold text-gray-800 ">Profil Saya </h2>
        <p class="text-muted small">
            Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
        </p>
    </div>
    <div class="bg-white p-6 rounded-lg mb-10 shadow-sm">
        <div class="">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data"
                class="mt-2 grid grid-cols-2 gap-3">
                @csrf
                @method('patch')
                <div class="flex flex-col justify-center ">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                            required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="alert alert-warning mt-2 d-flex align-items-center" role="alert">
                                <div>
                                    {{ __('Your email address is unverified.') }}
                                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </div>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                                <div class="alert alert-success mt-2">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Simpan') }}
                        </button>

                        @if (session('status') === 'profile-updated')
                            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-success">
                                {{ __('Saved.') }}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="flex flex-col items-center">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                    <img id="previewImage" class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover mb-4"
                        src="https://via.placeholder.com/150" alt="Preview">

                    <!-- Input File -->
                    <div class="relative">
                        <label for="image"
                            class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-500">
                            Upload Profile
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    <script>
        // Mendapatkan elemen HTML
        const previewImage = document.getElementById('previewImage');
        const fileInput = document.getElementById('image');
        const resetButton = document.getElementById('resetImage');

        // URL default (gambar yang sudah ada sebelumnya)
        const initialImageSrc = "https://via.placeholder.com/150"; // Ganti dengan URL gambar lama jika ada
        previewImage.src = initialImageSrc;

        // Fungsi untuk menampilkan gambar yang dipilih
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result; // Tampilkan gambar yang baru dipilih
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
