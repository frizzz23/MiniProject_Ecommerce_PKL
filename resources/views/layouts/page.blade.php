<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('loading/logo.png') }}" />


    {{-- swettalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                {{-- <!-- Search Input -->
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
                            @foreach ($categories as $category)
                                <li><button type="button"
                                        class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $category->name_category }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="relative">
                        <input type="search" id="search-dropdown"
                            class="block p-2.5 w-80 z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-[#7AB2D3] focus:ring-[#7AB2D3] focus:border-[#7AB2D3] dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Search product" required />
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
                </form> --}}
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
                                        <a href="{{ route('landing-page') }}"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Home</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="{{ route('product-page') }}"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Product</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="{{ route('category-page') }}"
                                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Category</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="{{ route('about-page') }}"
                                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">About</a>
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
                                    <div id="totalAmount"></div>
                                    <div class="grid gap-2 grid-cols-2 py-3">
                                        <a href="{{ route('user.carts.index') }}"
                                            class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg">See
                                            All</a>
                                        <a href="{{ route('user.orders.index') }}"
                                            class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 rounded-lg">Checkout</a>
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
        <div class="container">
            @yield('main')
        </div>    
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
                    <span class="ml-3 text-xl">Zen Tech</span>
                </a>
                <p class="mt-2 text-sm text-white">Air plant banjo lyft occupy retro adaptogen indego</p>
            </div>
            <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">
                        Feature</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a href="{{ route('product-page') }}" class="text-white hover:text-gray-800">product</a>
                        </li>
                        <li>
                            <a href="{{ route('category-page') }}"
                                class="text-white hover:text-gray-800">category</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">Page</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a href="{{ route('about-page') }}" class="text-white hover:text-gray-800">About</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-white tracking-widest text-sm mb-3">Category</h2>
                    <nav class="list-none mb-10">
                        @foreach ($categories as $category)
                            <li>
                                <a class="text-white hover:text-gray-800">{{ $category->name_category }}</a>
                            </li>
                        @endforeach
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>
