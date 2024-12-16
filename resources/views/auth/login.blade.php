@extends('layouts.guest')
@section('content')
    {{-- <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg " style="width: 70%; max-width: 1000px;">
            <div class="row g-0">
                <!-- Sisi Kiri: Gambar -->
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ asset('img/img-carousel-promo/onigasima.jpg') }}" alt="Login Image"
                        class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                </div>
                <!-- Sisi Kanan: Form Login -->
                <div class="col-md-6">
                    <div class="card-body p-4">
                        <!-- Logo -->
                        <a href="{{ asset('style/src/html/index.html') }}"
                            class="text-nowrap logo-img text-center d-block mb-4">
                            <img src="{{ asset('style/src/assets/images/logos/dark-logo.svg') }}" width="180"
                                alt="Logo">
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
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    autofocus autocomplete="username">
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
                                    <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot
                                        Password?</a>
                                @endif
                                <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Create an account</a>
                            </div>
                        </form>
                    </div>
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
                <form action="{{ route('login') }}" method="POST">
                    @csrf
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
                    <div class="mb-4 flex">
                        <input type="checkbox" id="remember_me" name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-white">Remember Me</label>
                    </div>
                    <button type="submit"
                        class="block w-full py-2 text-sm text-white bg-blue-700 rounded-md">Login</button>
                </form>

                <p class="text-white text-xs mt-10">
                    Don’t have an account yet? <a href="{{ route('register') }}" class="font-bold text-white">Register</a>
                    for free
                </p>
            </div>
        </div>
    </div>
@endsection
