@extends('layouts.guest')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg " style="width: 70%; max-width: 1000px;">
        <div class="row g-0">
            <!-- Sisi Kiri: Gambar -->
            <div class="col-md-6 d-none d-md-block">
                <img src="{{ asset('img/img-carousel-promo/onigasima.jpg') }}" 
                     alt="Login Image" 
                     class="img-fluid rounded-start" 
                     style="height: 100%; object-fit: cover;">
            </div>
            <!-- Sisi Kanan: Form Login -->
            <div class="col-md-6">
                <div class="card-body p-4">
                    <!-- Logo -->
                    <a href="{{ asset('style/src/html/index.html') }}"
                        class="text-nowrap logo-img text-center d-block mb-4">
                        <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180" alt="Logo">
                    </a>
                    <h5 class="card-title text-center mb-3">Sign In to Your Account</h5>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"  autofocus autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Remember this Device</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign In</button>

                        <!-- Additional Links -->
                        <div class="d-flex justify-content-between">
                            @if (Route::has('password.request'))
                                <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                            <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Create an account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
