<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zen Tech') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- font awesome start--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- font awesome end --}}


    <link rel="shortcut icon" type="image/png" href="{{ asset('loading/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('style/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('loading/loading.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="loader">
        <img src="{{ asset('loading/logo.png') }}" alt="Loading...">
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.sidebar')

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up p-2" aria-labelledby="drop2" style="min-width: 250px;">
                                    <div class="d-flex align-items-center p-3 border-bottom">
                                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}" alt=""
                                            width="60" height="60" class="rounded-circle me-3">
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                                            <span class="text-muted">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        <form action="{{ route('logout') }}" method="POST" class="my-2">
                                            @csrf
                                            <button type="submit" 
                                                    class="dropdown-item px-3 py-2 d-flex align-items-center gap-2 text-danger">
                                                <i class="ti ti-logout fs-6"></i>
                                                <p class="mb-0 fs-3">Logout</p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('main')
            </div>
        </div>
    </div>
    <script src="{{ asset('style/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('style/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('style/src/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('loading/loading.js') }}"></script>
</body>

</html>
