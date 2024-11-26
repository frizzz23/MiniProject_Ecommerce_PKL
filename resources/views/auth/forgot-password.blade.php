@extends('layouts.guest')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 70%; max-width: 1000px;">
        <div class="row g-0">
            <!-- Sisi Kiri: Gambar -->
            <div class="col-md-6 d-none d-md-block">
                <img src="{{ asset('img/img-carousel-promo/onigasima.jpg') }}" 
                     alt="Forgot Password Image" 
                     class="img-fluid rounded-start" 
                     style="height: 100%; object-fit: cover;">
            </div>
            <!-- Sisi Kanan: Form -->
            <div class="col-md-6">
                <div class="card-body p-4">
                    <!-- Logo -->
                    <a href="{{ asset('style/src/html/index.html') }}"
                        class="text-nowrap logo-img text-center d-block mb-4">
                        <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180" alt="Logo">
                    </a>
                    <h5 class="card-title text-center mb-3">Forgot Password</h5>

                    <div class="mb-4 text-muted text-center">
                        {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link.') }}
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4">
                            {{ __('Send Password Reset Link') }}
                        </button>

                        <!-- Back to Login -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-primary fw-bold">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
