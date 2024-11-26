<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>


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
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mockups</button></li>
                            <li><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Templates</button></li>
                            <li><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Design</button></li>
                            <li><button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button></li>
                        </ul>
                    </div>
                    <div class="relative">
                        <input type="search" id="search-dropdown" class="block p-2.5 w-80 z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-[#7AB2D3] focus:ring-[#7AB2D3] focus:border-[#7AB2D3] dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Mockups, Logos, Design Templates..." required />
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-[#7AB2D3] rounded-e-lg border border-[#7AB2D3] hover:bg-[#7AB2D3] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Login & Register -->
            <div class="flex space-x-4">
                <a href="#" class="text-black hover:text-blue-400">Login</a>
                <a href="#" class="text-black hover:text-blue-400">Register</a>
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
                                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                                    <li>
                                        <a href="#" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Home</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Best Sellers</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Gift Ideas</a>
                                    </li>
                                    <li class="shrink-0">
                                        <a href="#" class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">Today's Deals</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Cart Section -->
                            <div class="flex items-center lg:space-x-2 ml-auto">
                                <!-- Cart Dropdown Button -->
                                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                                    <span class="sr-only">Cart</span>
                                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                                    </svg>
                                    <span class="hidden sm:flex">My Cart</span>
                                    <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Cart Dropdown -->
                                <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                                            <!-- Cart Item 1 -->
                                            <div class="grid grid-cols-2">
                                                <div>
                                                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple iPhone 15</a>
                                                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$599</p>
                                                </div>
                                                <div class="flex items-center justify-end gap-6">
                                                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
                                                    <button data-tooltip-target="tooltipRemoveItem1a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                        <span class="sr-only"> Remove </span>
                                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                    <div id="tooltipRemoveItem1a" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                                        Remove item
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cart Item 2 -->
                                            <div class="grid grid-cols-2">
                                                <div>
                                                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple iPad Air</a>
                                                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$499</p>
                                                </div>
                                                <div class="flex items-center justify-end gap-6">
                                                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
                                                    <button data-tooltip-target="tooltipRemoveItem2a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                        <span class="sr-only"> Remove </span>
                                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                    <div id="tooltipRemoveItem2a" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                                        Remove item
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cart Item 3 -->
                                            <div class="grid grid-cols-2">
                                                <div>
                                                    <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">Apple Watch SE</a>
                                                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$598</p>
                                                </div>
                                                <div class="flex items-center justify-end gap-6">
                                                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>
                                                    <button data-tooltip-target="tooltipRemoveItem3a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                        <span class="sr-only"> Remove </span>
                                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                    <div id="tooltipRemoveItem3a" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                                        Remove item
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cart Total -->
                                            <div class="grid grid-cols-2 py-3">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">Total</p>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">$1696</p>
                                            </div>
                                            <div class="grid grid-cols-2 py-3">
                                                <a href="#" class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-lg">See All</a>
                                                <a href="#" class="inline-block w-full py-2 text-center text-sm font-semibold text-white bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 rounded-lg">Checkout</a>
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
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100/50 group-hover:bg-gray-300/50">
                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100/50 group-hover:bg-gray-300/50">
                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
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
                <!-- Category Item 1 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3 class="text-lg font-medium">Laptops & Computers</h3>
                </div>

                <!-- Category Item 2 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-tv"></i>
                    </div>
                    <h3 class="text-lg font-medium">TV</h3>
                </div>

                <!-- Category Item 3 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-tablet-alt"></i>
                    </div>
                    <h3 class="text-lg font-medium">Tablets</h3>
                </div>

                <!-- Category Item 4 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-headphones-alt"></i>
                    </div>
                    <h3 class="text-lg font-medium">Audio</h3>
                </div>

                <!-- Category Item 5 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-print"></i>
                    </div>
                    <h3 class="text-lg font-medium">Printers</h3>
                </div>

                <!-- Category Item 6 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <h3 class="text-lg font-medium">Computer Accessories</h3>
                </div>

                <!-- Category Item 7 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <h3 class="text-lg font-medium">Computer Accessories</h3>
                </div>

                <!-- Category Item 8 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <h3 class="text-lg font-medium">Computer Accessories</h3>
                </div>

                <!-- Category Item 9 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <h3 class="text-lg font-medium">Computer Accessories</h3>
                </div>

                <!-- Category Item 10 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <h3 class="text-lg font-medium">Computer Accessories</h3>
                </div>

                <!-- Category Item 11 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-lg font-medium">Security & Wi-Fi</h3>
                </div>

                <!-- Category Item 12 -->
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-white">
                    <div class="text-4xl mb-4">
                        <!-- Replace this with actual icons -->
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="text-lg font-medium">Deals</h3>
                </div>
            </div>

            <!-- See all categories button -->
            <div class="mt-6 text-center">
                <button class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    See all categories
                </button>
            </div>
        </div>
        <!-- end category -->

        <!-- Carousel Promo -->
        <div>
            <h2 class="text-2xl font-semibold text-white mb-8">Promo Sale</h2>
        </div>
        <div class="carousel carousel-center bg-neutral rounded-box max-w-full space-x-4 p-4 h-96">
            <div class="carousel-item space-x-4">
                <!-- item 1 -->
                <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <span class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                        Save 10%
                    </span>
                    <a href="#">
                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7" src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                    </a>
                    <div class="px-5 pb-5 mt-10">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Laptop Geming</h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700">
                                $49.99
                                <span class="text-gray-400 line-through">$80</span>
                            </p>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
                <!-- item 2 -->
                <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <span class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                        Save 10%
                    </span>
                    <a href="#">
                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7" src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                    </a>
                    <div class="px-5 pb-4 mt-10">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Laptop Geming</h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700">
                                $49.99
                                <span class="text-gray-400 line-through">$80</span>
                            </p>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
                <!-- item 3 -->
                <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <span class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                        Save 10%
                    </span>
                    <a href="#">
                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7" src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                    </a>
                    <div class="px-5 pb-4 mt-10">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Laptop Geming</h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700">
                                $49.99
                                <span class="text-gray-400 line-through">$80</span>
                            </p>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
                <!-- item 4 -->
                <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <span class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                        Save 10%
                    </span>
                    <a href="#">
                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7" src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                    </a>
                    <div class="px-5 pb-4 mt-10">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Laptop Geming</h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700">
                                $49.99
                                <span class="text-gray-400 line-through">$80</span>
                            </p>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
                <!-- item 5 -->
                <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <span class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-4xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white">
                        Save 10%
                    </span>
                    <a href="#">
                        <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7" src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
                    </a>
                    <div class="px-5 pb-4 mt-10">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Laptop Geming</h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700">
                                $49.99
                                <span class="text-gray-400 line-through">$80</span>
                            </p>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- end promo -->

        <!-- P -->
    </main>
    <!-- End Banner -->

    <!-- Footer -->
    <footer class="bg-[#1E3E62] text-gray-100 body-font">
        <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-[#7AB2D3] rounded-full" viewBox="0 0 24 24">
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
                <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-white ml-1" target="_blank">@knyttneve</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                <a class="text-white">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
                </a>
                <a class="ml-3 text-white">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                </svg>
                </a>
                <a class="ml-3 text-white">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
                </a>
                <a class="ml-3 text-white">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                    <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
                </a>
            </span>
            </div>
        </div>
    </footer>
    <!-- end footer -->





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
</body>
</html>
