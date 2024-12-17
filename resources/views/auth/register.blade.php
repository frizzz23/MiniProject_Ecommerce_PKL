@extends('layouts.guest')

@section('content')
    {{-- <div class="d-flex justify-content-center align-items-center vh-100 mt-2">
        <div class="card shadow-lg " style="width:70%; max-width: 1000px;">
            <div class="row g-0">
                <!-- Sisi Kiri: Gambar -->

                <!-- Sisi Kanan: Form Register -->
                <div class="col-md-6">
                    <div class="card-body p-4">
                        <!-- Logo -->
                        <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180"
                                alt="Logo">
                        </a>
                        <h5 class="card-title text-center mb-3">Create Your Account</h5>
                        <p class="text-center text-muted">Join us and start your journey</p>

                        <!-- Register Form -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" >
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign Up</button>

                            <!-- Login Link -->
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="mb-0">Already have an Account?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div> <!-- End Sisi Kanan -->

                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ asset('img/img-carousel-promo/onigasima.jpg') }}" alt="Register Image"
                        class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div> --}}
    <div class="flex justify-center items-center min-h-screen p-4"
        style="background: radial-gradient(135.69% 188.95% at 53.72% 47.02%, #0085FF 0%, #003465 64.5%) /* warning: gradient uses a rotation that is not supported by CSS and may not behave as expected */;
">
        <div class="px-14 py-10 pb-5 rounded-md  w-full md:w-1/3 flex flex-col items-center"
            style="background: linear-gradient(148.46deg, rgba(255, 255, 255, 0.3) -47.18%, rgba(255, 255, 255, 0.11) 131%);
">
            <div class="w-full">
                <h1 class="font-bold text-white text-3xl mb-3 text-center mb-4">Sign In</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-white text-xs mb-1">Name</label>
                        <input type="text" id="name" name="name"
                            class="outline-none w-full py-2 text-xs px-3 rounded text-slate-800" value="{{ old('name') }}"
                            autofocus placeholder="name">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-white text-xs mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="outline-none w-full py-2 text-xs px-3 rounded text-slate-800" value="{{ old('email') }}"
                            autofocus placeholder="example@gmail.com">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-white text-xs mb-1">Password</label>
                        <input type="password" id="password" name="password"
                            class="outline-none w-full py-2 text-xs px-3 rounded text-slate-800"
                            value="{{ old('password') }}" placeholder="password">
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-white text-xs mb-1">Confirmation
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="outline-none w-full py-2 text-xs px-3 rounded text-slate-800"
                            value="{{ old('password_confirmation') }}" placeholder="password_confirmation">
                        @error('password_confirmation')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="block w-full py-2 text-sm text-white bg-blue-700 rounded-md">Register</button>
                </form>

                <p class="text-white text-xs mt-10">
                    Already have an Account? <a href="{{ route('login') }}" class="font-bold text-white">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                 autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                 autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation"  autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
