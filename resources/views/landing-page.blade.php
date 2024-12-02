<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @guest
        <title>Landing Page</title>
    @endguest

    @auth
        <title>Home Page</title>
    @endauth


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('loading/logo.png') }}" />

</head>

<body class="bg-white">
    <!-- Double Layered Navbar -->
    <nav class="relative z-50 bg-white shadow">
        <!-- Top Layer -->
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <!-- Logo and Search -->
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <a href="#" class="text-2xl font-bold text-gray-900">
                    Zen<span class="text-[#7AB2D3]">Tech</span>
                </a>

                <!-- Search Input -->
                <form class="flex items-center">
                    <button id="dropdown-button" data-dropdown-toggle="dropdown"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                        type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li><button type="button"
                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mockups</button>
                            </li>
                            <li><button type="button"
                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Templates</button>
                            </li>
                            <li><button type="button"
                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Design</button>
                            </li>
                            <li><button type="button"
                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button>
                            </li>
                        </ul>
                    </div>
                    <div class="relative">
                        <input type="search" id="search-dropdown"
                            class="block p-2.5 w-80 z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-[#7AB2D3] focus:ring-[#7AB2D3] focus:border-[#7AB2D3] dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Search Mockups, Logos, Design Templates..." required />
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-[#7AB2D3] rounded-e-lg border border-[#7AB2D3] hover:bg-[#7AB2D3] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Login & Register -->
            <div class="flex space-x-4">
                @guest
                    <!-- Jika pengguna belum login -->
                    <a href="{{ route('login') }}" class="text-black hover:text-blue-400">Login</a>
                    <a href="{{ route('register') }}" class="text-black hover:text-blue-400">Register</a>
                @endguest

                @auth
                    <!-- Jika pengguna sudah login -->
                    <div class="flex space-x-4">
                        <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                            class="inline-flex items-center rounded-lg justify-center p-2  bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                            <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                    d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Account
                            <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="userDropdown1"
                            class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                            <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                                <li><a href="{{ route('profile.edit') }}"
                                        class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">My
                                        Account</a></li>
                                <li><a href="{{ route('user.orders.index') }}"
                                        class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">My
                                        Orders</a></li>
                                <li><a href="{{ route('user.carts.index') }}"
                                        class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">My
                                        Cart</a></li>
                                <li><a href="{{ route('user.addresses.index') }}"
                                        class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">My
                                        Address</a></li>
                            </ul>

                            <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Sign
                                    Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>

        <!-- Bottom Layer -->
        <div class="bg-gray-50">
            <div class="container mx-auto flex justify-between items-center">
                <nav class="bg-white dark:bg-gray-800 antialiased w-full">
                    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
                        <div class="flex items-center justify-between">
                            <!-- Left Navigation -->
                            <div class="flex items-center space-x-8">
                                <ul
                                    class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                                    <li>
                                        <a href="#"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Home</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Best
                                            Sellers</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Gift
                                            Ideas</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#"
                                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Today's
                                            Deals</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Cart Section -->
                            <div class="flex items-center lg:space-x-2 ml-auto">
                                <!-- Cart Dropdown Button -->
                                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1"
                                    type="button"
                                    class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                                    <span class="sr-only">Cart</span>
                                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                    </svg>
                                    <span class="hidden sm:flex">My Cart</span>
                                    <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Cart Dropdown -->
                                <div id="myCartDropdown1"
                                    class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                                    <!-- Cart Item 1 -->
                                    <div id="cartItems"></div>
                                    <div class="grid grid-cols-2 py-3">
                                        <a href="{{ route('user.carts.index') }}"
                                            class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg">See
                                            All</a>
                                        <a href="#"
                                            class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 rounded-lg">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </nav>
    </div>
    </div>
    </nav>
    <!-- end navbar -->

    <!-- Banner Carousel -->
    <main class="container mx-auto px-2 py-16">
        <!-- Carousel Container -->
        <div class="flex flex-wrap lg:flex-nowrap gap-1">
            <!-- Primary Carousel -->
            <div class="flex-1 w-full lg:w-2/3">
                <div id="gallery" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-60 overflow-hidden rounded-lg">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg"
                                class="absolute block w-full h-full object-cover" alt="Image 1">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                class="absolute block w-full h-full object-cover" alt="Image 2">
                        </div>
                        <!-- Add more items as needed -->
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100/50 group-hover:bg-gray-300/50">
                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100/50 group-hover:bg-gray-300/50">
                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <!-- Secondary Carousel -->
            <div class="flex-1 w-full lg:w-1/3 relative">
                <!-- Tombol di atas carousel -->
                <button id="prev"
                    class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-gray-200 p-2 rounded-full shadow z-10">
                    &uarr;
                </button>

                <!-- Carousel -->
                <div id="carousel" class="h-60 overflow-hidden rounded-lg shadow-lg">
                    <!-- Konten carousel -->
                    <div id="carousel-content" class="flex flex-col transition-transform duration-500 h-full">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="carousel-item p-2 justify-center items-center">
                                <div class="card w-full">
                                    <div class="flex items-center justify-center p-9 bg-gray-800 rounded-lg shadow">
                                        <span class="text-3xl font-semibold">{{ $i }}</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Tombol di bawah carousel -->
                <button id="next"
                    class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-200 p-2 rounded-full shadow z-10">
                    &darr;
                </button>
            </div>
        </div>

        <!-- Category -->
        <div class="max-w-7xl mx-auto py-12">
            <h2 class="text-2xl font-semibold text-white mb-8">Kategori</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">

                @foreach ($categories as $category)
                    <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                        <div class="text-4xl mb-4">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3 class="text-lg font-medium">{{ $category->name_category }}</h3>
                    </div>
                @endforeach
            </div>

            <!-- See all categories button -->
            <div class="mt-6 text-center">
                <div class="flex items-center justify-center">
                    <!-- Garis Horizontal Sebelah Kiri -->
                    <hr class="w-32 h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <!-- Tombol "See all categories" -->
                    <a href="#"
                        class="mx-4 bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        See all categories
                    </a>
                    <!-- Garis Horizontal Sebelah Kanan -->
                    <hr class="w-32 h-px bg-gray-200 border-0 dark:bg-gray-700">
                </div>
            </div>
        </div>
        <!-- end category -->

        <!-- Carousel Promo -->
        <div>
            <h2 class="text-2xl font-semibold text-white mb-8">Promo Sale</h2>
        </div>
        <div class="carousel carousel-center bg-neutral rounded-box max-w-full space-x-4 p-4 h-96 mb-8">
            <div class="carousel-item space-x-4">
                @foreach ($products as $product)
                    @if ($loop->iteration != $limit)
                        <div
                            class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                            {{-- <span
                                class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                                Save 10%
                            </span> --}}
                            <a href="#">
                                @if ($product->image_product)
                                    <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                        src="{{ asset('storage/' . $product->image_product) }}"
                                        alt="product image" />
                                @else
                                    <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                        src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                                @endif
                            </a>
                            <div class="px-5 pb-5 mt-10">
                                <a href="#">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ $product->name_product }}</h5>
                                </a>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-400">
                                        Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                        {{-- <span class="text-gray-400 line-through">$80</span> --}}
                                    </p>
                                    <button type="button"
                                        @auth
@if (auth()->user()->hasRole('user'))
onclick="addToCart('{{ $product->id }}')"
@endif @endauth
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- See More -->
                        <div class="relative w-full max-w-xs">
                            <!-- Layer Bawah -->
                            <div
                                class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                {{-- <span
                                    class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white z-10">
                                    Save 90%
                                </span> --}}
                                <a href="#">
                                    @if ($product->images_product)
                                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                            src="{{ asset('storage/' . $product->image_product) }}"
                                            alt="product image" />
                                    @else
                                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                            src="{{ asset('img/img-carousel-promo/laptop.jpg') }}"
                                            alt="product image" />
                                    @endif
                                </a>
                                <div class="px-5 pb-4 mt-10">
                                    <a href="#">
                                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ $product->name_product }}</h5>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-400">
                                            Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                            {{-- <span class="text-gray-400 line-through">$80</span> --}}
                                        </p>
                                        <button type="button"
                                            @auth
                                                @if (auth()->user()->hasRole('user'))
                                            onclick="addToCart('{{ $product->id }}')"
                                                @endif 
                                            @endauth
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Layer Atas (Blur dengan Tombol) -->
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-white/70 backdrop-blur-xs rounded-bl-3xl z-20">
                                <button
                                    class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    See More
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        </div>
        <!-- end promo -->

        <!-- Informasi E-commerce -->
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <h2 class="text-center text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Informasi
                        E-commerce</h2>
                    <div class="my-8 xl:mb-16 xl:mt-12">
                        <img class="w-full dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase.svg"
                            alt="Gambar E-commerce" />
                        <img class="hidden w-full dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase-dark.svg"
                            alt="Gambar E-commerce" />
                    </div>
                    <div class="mx-auto max-w-2xl space-y-6 text-left">
                        <p class="text-left font-normal text-gray-500 dark:text-gray-400">
                            E-commerce, atau perdagangan elektronik, adalah aktivitas jual beli produk atau layanan
                            secara online melalui platform digital. Dengan e-commerce, pelanggan dapat dengan mudah
                            menemukan dan membeli produk dari kenyamanan rumah mereka.
                        </p>

                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            Sistem e-commerce modern menawarkan fitur canggih seperti pengelolaan inventaris, opsi
                            pembayaran yang beragam, dan pengiriman yang terintegrasi. Ini memungkinkan bisnis untuk
                            menjangkau audiens yang lebih luas dan meningkatkan penjualan mereka secara signifikan.
                        </p>

                        <p class="text-base font-semibold text-gray-900 dark:text-white">Keunggulan Utama E-commerce:
                        </p>
                        <ul
                            class="list-outside list-disc space-y-4 pl-4 text-base font-normal text-gray-500 dark:text-gray-400">
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Kemudahan Akses: </span>
                                Pelanggan dapat berbelanja kapan saja dan di mana saja tanpa terbatas waktu dan lokasi.
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Pilihan Produk Lebih Banyak:
                                </span>
                                Menyediakan akses ke berbagai produk dari berbagai penjual dalam satu platform.
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Metode Pembayaran Aman:
                                </span>
                                Menawarkan opsi pembayaran digital yang aman, termasuk kartu kredit, e-wallet, dan
                                transfer bank.
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Efisiensi Operasional:
                                </span>
                                Memudahkan manajemen stok, pesanan, dan pengiriman barang secara otomatis.
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">Analitik dan Laporan: </span>
                                Memberikan wawasan berbasis data untuk membantu bisnis meningkatkan strategi pemasaran.
                            </li>
                        </ul>
                    </div>
                    <div class="my-6 md:my-12">
                        <iframe class="h-[260px] md:h-[540px] w-full rounded-lg"
                            src="https://www.youtube.com/embed/KaLxCiilHns" title="Video Pengantar E-commerce"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="mx-auto mb-6 max-w-3xl space-y-6 text-left md:mb-12">
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            Dengan platform e-commerce, konektivitas meliputi berbagai fitur seperti integrasi dengan
                            media sosial, alat promosi digital, dan layanan pelanggan yang responsif.
                        </p>

                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            Investasi dalam e-commerce dapat memberikan keuntungan jangka panjang bagi bisnis, baik
                            dalam meningkatkan efisiensi operasional maupun memperluas pasar secara global.
                        </p>
                    </div>
                    <div class="text-left">
                        <a href="#"
                            class="mb-2 mr-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Pelajari
                            lebih lanjut...</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir Informasi -->
    </main>
    <!-- End Banner -->

    <!-- Footer -->
    <footer class="bg-[#1E3E62] text-gray-100 body-font">
        <div
            class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-10 h-10 text-white p-2 bg-[#7AB2D3] rounded-full" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="ml-3 text-xl">Tailblocks</span>
                </a>
                <p class="mt-2 text-sm text-white">Air plant banjo lyft occupy retro adaptogen indego</p>
            </div>
            <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-white hover:text-gray-800">First Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Second Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Third Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-white hover:text-gray-800">First Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Second Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Third Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-white hover:text-gray-800">First Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Second Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Third Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-white hover:text-gray-800">First Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Second Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Third Link</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-gray-800">Fourth Link</a>
                        </li>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bg-[#1E3E62]">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-white text-sm text-center sm:text-left">© 2020 Tailblocks —
                    <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-white ml-1"
                        target="_blank">@knyttneve</a>
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                    <a class="text-white">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none"
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    {{-- <!-- Cart Total -->
     <div class="grid grid-cols-2 py-3">
         <p class="text-sm font-semibold text-gray-900 dark:text-white">Total</p>
         <p class="text-sm font-semibold text-gray-900 dark:text-white">$1696</p>
         </div> --}}



    @auth
        <script>
            function listCart(data) {
                let items = ''
                const cartItems = document.getElementById('cartItems');
                data.forEach(item => {
                    items += `
        <div class="grid grid-cols-2">
            <div>
                <a href="#"
                    class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">${item.product.name_product}</a>
                <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                    Rp. ${(item.product.price_product * item.quantity).toLocaleString()}
                </p>
            </div>
            <div class="flex items-center justify-end gap-6">
                <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                    Qty: ${item.quantity}</p>
                <button onclick="return confirm('kamu yakin ingin menghapus keranjang ini?') ? deleteCart('${item.id}') : false;"
                    class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                    <span class="sr-only"> Remove </span>
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="tooltipRemoveItem1a"
                    class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                    Remove item
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
        `
                })
                cartItems.innerHTML = items;
            }
        </script>
        @if (auth()->user()->hasRole('user'))
            <script>
                async function addToCart(id_product) {
                    const api = await fetch('/api/cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            id_product: id_product
                        })
                    });

                    const response = await api.json();
                    if (response.status == 'success') {
                        const data = await response.data;
                        listCart(data);
                    } else {
                        alert('error');
                    }
                }

                async function deleteCart(id_cart) {
                    const api = await fetch('/api/cart/' + id_cart, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    const response = await api.json();

                    if (response.status == 'success') {
                        const data = await response.data;
                        listCart(data);
                    } else {
                        alert('error');
                    }

                }
            </script>
        @endif

        <script>
            window.addEventListener('DOMContentLoaded', async () => {
                const api = await fetch('/api/cart', {
                    method: 'GET',
                });
                const response = await api.json();
                if (response.status == 'success') {
                    const data = await response.data;
                    listCart(data);
                } else {
                    alert('error');
                }
            })
        </script>
    @endauth


    <!-- Dropdown Script -->
    <script>
        document.getElementById('cartDropdownButton').addEventListener('click', () => {
            document.getElementById('cartDropdownMenu').classList.toggle('hidden');
        });

        document.getElementById('userDropdownButton').addEventListener('click', () => {
            document.getElementById('userDropdownMenu').classList.toggle('hidden');
        });
    </script>

    <!-- Carousel Vertical -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carouselContent = document.getElementById('carousel-content');
            const items = document.querySelectorAll('.carousel-item');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            const itemHeight = items[0].offsetHeight; // Tinggi setiap item
            let currentIndex = 0;

            function updateCarousel() {
                // Perbarui posisi carousel berdasarkan indeks saat ini
                carouselContent.style.transform = `translateY(-${currentIndex * itemHeight}px)`;
            }

            nextButton.addEventListener('click', () => {
                // Jika di item terakhir, langsung reset ke item pertama tanpa transisi
                if (currentIndex === items.length - 1) {
                    currentIndex = 0;
                    // Setel ulang posisi carousel untuk mencocokkan item pertama tanpa animasi
                    carouselContent.style.transition = 'none';
                    updateCarousel();

                    // Setelah sedikit delay, aktifkan transisi lagi untuk seterusnya
                    setTimeout(() => {
                        carouselContent.style.transition = 'transform 0.5s ease';
                    }, 50);
                } else {
                    currentIndex++;
                    updateCarousel();
                }
            });

            prevButton.addEventListener('click', () => {
                // Jika di item pertama, pindah ke item terakhir tanpa transisi
                if (currentIndex === 0) {
                    currentIndex = items.length - 1;
                    carouselContent.style.transition = 'none';
                    updateCarousel();

                    // Setelah sedikit delay, aktifkan transisi lagi untuk seterusnya
                    setTimeout(() => {
                        carouselContent.style.transition = 'transform 0.5s ease';
                    }, 50);
                } else {
                    currentIndex--;
                    updateCarousel();
                }
            });

            // Optional: Auto-scroll setiap 3 detik
            setInterval(() => {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
            }, 3000); // 3 detik
        });
    </script>

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>
