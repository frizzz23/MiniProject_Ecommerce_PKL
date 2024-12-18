<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Detail </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('desainmini-main/dist/output.css') }}" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Poppins", sans-serif;
            /* border: 1px solid black; */
        }
    </style>
</head>

<body class="px-5">

    <!-- start menu-->
    <div id="list-menu"
        class="hidden w-full h-screen overflow-hidden fixed top-0 right-0 left-0 bottom-0 z-20 backdrop-brightness-50 flex justify-center p-5">
        <div id="menu-content" class="relative bg-white shadow-xl h-full w-full rounded-md md:w-2/5">
            <div class="absolute top-0 right-0 cursor-pointer m-3" id="close-menu">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M10.0303 8.96965C9.73741 8.67676 9.26253 8.67676 8.96964 8.96965C8.67675 9.26255 8.67675 9.73742 8.96964 10.0303L10.9393 12L8.96966 13.9697C8.67677 14.2625 8.67677 14.7374 8.96966 15.0303C9.26255 15.3232 9.73743 15.3232 10.0303 15.0303L12 13.0607L13.9696 15.0303C14.2625 15.3232 14.7374 15.3232 15.0303 15.0303C15.3232 14.7374 15.3232 14.2625 15.0303 13.9696L13.0606 12L15.0303 10.0303C15.3232 9.73744 15.3232 9.26257 15.0303 8.96968C14.7374 8.67678 14.2625 8.67678 13.9696 8.96968L12 10.9393L10.0303 8.96965Z"
                            fill="#1C274C"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z"
                            fill="#1C274C"></path>
                    </g>
                </svg>
            </div>
            <div class="p-5">
                <ul>
                    <li>
                        <div class="pt-10 pb-5 border-b-2">
                            <form action="" class="flex gap-2 flex-1 w-full">
                                <input type="text"
                                    class="py-1 px-3 outline-none border border-gray-300 rounded-lg text-sm w-full text-slate-700"
                                    placeholder="Search" />
                                <button type="submit">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}" class="text-md text-slate-700 py-2 block">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('page.product') }}" class="text-md text-slate-700 py-2 block">Product</a>
                    </li>
                    <li>
                        <a href="" class="text-md text-slate-700 py-2 block">Category</a>
                    </li>
                    <li>
                        <a href="#" class="text-md text-slate-700 py-2 block">About</a>
                    </li>

                    <li>
                        <a href="#"
                            class="text-sm block py-2 w-full rounded-lg bg-blue-500 text-white text-center mb-3">Sign
                            in</a>
                    </li>
                    <li>
                        <a href="#" class="text-sm block py-2 w-full rounded-lg text-blue-500 text-center">Sign
                            up</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end menu-->

    <x-list-cart-modal />

    <div style="">
        <div class="px-5">
            <div class="flex w-full justify-between gap-5 mb-5 sticky top-0 z-10 bg-white py-3 md:pe-5">
                <a href="{{ route('landing-page') }}">
                    <h5 class="font-semibold text-xl text-slate-700 mb-5 text-center">
                        Zentech
                    </h5>
                </a>
                <form action="{{ route('page.product') }}" method="GET"
                    class=" gap-2 flex-1 md:flex-none hidden gap-1 bg-gray-100 rounded-full items-center xl:flex py-2 px-5">
                    <input type="text" name="search" value="{{ request()->get('search') }}"
                        class=" outline-none text-sm w-full text-slate-800 md:w-80 bg-transparent"
                        placeholder="Search" />
                    <button type="submit">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                    stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </button>
                </form>

                <div class="flex gap-1 items-center cursor-pointer">
                    <div class="flex gap-1" id="carts">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                                <path
                                    d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                                <path
                                    d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                            </g>
                        </svg>
                        <span class="text-sm text-slate-700">Keranjang</span>

                        <span class="relative flex h-4 w-4 -translate-y-2 -translate-x-1">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center"
                                id="cartCountItem"> 0</span>
                        </span>
                    </div>

                    <div class="hidden gap-1 items-center xl:flex">
                        @guest
                            <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" class="w-4 h-4">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <defs></defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-420.000000, -2159.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M374,2009 C371.794,2009 370,2007.206 370,2005 C370,2002.794 371.794,2001 374,2001 C376.206,2001 378,2002.794 378,2005 C378,2007.206 376.206,2009 374,2009 M377.758,2009.673 C379.124,2008.574 380,2006.89 380,2005 C380,2001.686 377.314,1999 374,1999 C370.686,1999 368,2001.686 368,2005 C368,2006.89 368.876,2008.574 370.242,2009.673 C366.583,2011.048 364,2014.445 364,2019 L366,2019 C366,2014 369.589,2011 374,2011 C378.411,2011 382,2014 382,2019 L384,2019 C384,2014.445 381.417,2011.048 377.758,2009.673"
                                                    id="profile-[#1335]"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <!-- Jika pengguna belum login -->
                            <a href="{{ route('login') }}" class="text-sm text-slate-700 hover:text-blue-400">Sign in</a>
                            <span>/</span>
                            <a href="{{ route('register') }}" class="text-sm text-slate-700 hover:text-blue-400">Sign
                                up</a>
                        @endguest
                        @auth
                            <div class="tooltip">
                                <a href="{{ route('user.profile.profile') }}"
                                    class="flex justify-start items-center gap-1 text-md py-2 bg-gray-200 text-slate-800 w-auto  px-2 rounded-full">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <!-- Lingkaran untuk kepala -->
                                            <circle cx="12" cy="8" r="4" stroke="#1C274C"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            </circle>
                                            <!-- Kurva untuk tubuh -->
                                            <path d="M4 20C4 16 8 14 12 14C16 14 20 16 20 20" stroke="#1C274C"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <span class="tooltiptext">My Account</span>
                                </a>

                            </div>
                        @endauth
                    </div>


                </div>

                <!-- Hamburger Menu (untuk tampilan mobile) -->
                <div class="xl:hidden flex items-center gap-4">
                    <button id="hamburger" class="text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

            </div>

            <div class="flex justify-between items md:pe-5">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="flex items-center">
                            <a href="{{ route('landing-page') }}"
                                class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 w-auto py-1.5 px-2 rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M6.49996 7C7.96131 5.53865 9.5935 4.41899 10.6975 3.74088C11.5021 3.24665 12.4978 3.24665 13.3024 3.74088C14.4064 4.41899 16.0386 5.53865 17.5 7C20.6683 10.1684 20.5 12 20.5 15C20.5 16.4098 20.3895 17.5988 20.2725 18.4632C20.1493 19.3726 19.3561 20 18.4384 20H17C15.8954 20 15 19.1046 15 18V16C15 15.2043 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87864 13.8787C9.31603 14.4413 8.99996 15.2043 8.99996 16V18C8.99996 19.1046 8.10453 20 6.99996 20H5.56152C4.64378 20 3.85061 19.3726 3.72745 18.4631C3.61039 17.5988 3.49997 16.4098 3.49997 15C3.49997 12 3.33157 10.1684 6.49996 7Z"
                                            stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                <span class="font-semibold text-xs"> Home</span>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="mx-2 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3" d="m9 5 7 7-7 7" />
                                </svg>
                                <a href="{{ route('page.product') }}"
                                    class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 mx-2 w-auto py-2 px-2 rounded-md">
                                    <span class="font-semibold text-xs">Product</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="mx-2 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3" d="m9 5 7 7-7 7" />
                                </svg>
                                <div
                                    class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 mx-2 w-auto py-2 px-2 rounded-md">
                                    <span class="font-semibold text-xs">
                                        {{ $product->name_product }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex gap-2 items-center">
                    <button id="filter"
                        class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 w-auto py-2 px-2 rounded-md">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M7.60848 4C6.03761 4 5.07993 5.7279 5.91249 7.06L8.08798 10.5408C8.68397 11.4944 8.99999 12.5963 8.99999 13.7208V16.7639C8.99999 17.5215 9.42799 18.214 10.1056 18.5528L13.5528 20.2764C14.2177 20.6088 15 20.1253 15 19.382V13.7208C15 12.5963 15.316 11.4944 15.912 10.5408L18.0875 7.06C18.9201 5.7279 17.9624 4 16.3915 4H7.60848Z"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <span class="font-semibold text-xs"> Filter</span>
                    </button>
                </div>
            </div>

            <div class="mt-10 grid md:grid-cols-[2fr_1.5fr] grid-cols-1 gap-5 pe-5 md:mb-10 mb-5">
                <div class="border-2 w-full h-96 md:h-96 overflow-hidden bg-center">
                    @if ($product->image_product)
                        <img src="{{ asset('storage/' . $product->image_product) }}"
                            alt="{{ $product->name_product }}" class="w-full h-full object-contain">
                    @else
                        <img src="{{ asset('landing/image/laptop') }}-2.png" alt="Laptop"
                            class="w-full h-full object-contain" />
                    @endif
                </div>

                <div class="border-2 min-h-96 md:h-96 p-6 flex flex-col justify-between">
                    <div class="flex items-center gap-2">
                        <h2 class="text-2xl font-bold text-slate-800">
                            {{ $product->name_product }}
                        </h2>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="text-lg text-slate-800 font-medium tracking-tight">
                            Stock : {{ $product->stock_product }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Loop untuk menampilkan rating berdasarkan averageRating -->
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                viewBox="0 0 24 24" stroke="none">
                                <path
                                    d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                </path>
                            </svg>
                        @endfor
                        <span class="text-sm text-slate-600">{{ $reviewsCount }} Reviews</span>
                        <!-- Menampilkan jumlah review -->
                    </div>



                    <div class="flex items-center gap-2">
                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                            Rp {{ number_format($product->price_product, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- <div class="flex items-center gap-2 ">
                        <span class="text-slate-800 text-md font-medium">Kuantitas</span>
                        <div class="flex items-center border-2 border-blue-200 rounded-md mb-4 w-32">
                            <button class="p-2" onclick="minus('quantity')">-</button>
                            <input type="text" class="w-full outline-none p-2 text-center" value="1"
                                id="quantity" readonly />
                            <button class="p-2" onclick="plus('quantity', 20)">+</button>
                        </div>
                    </div> --}}

                    <div class="flex gap-5 items-center w-full">
                        @auth
                            <button onclick="addToCart({{ $product->id }}, this)" type="button"
                                class="py-3 px-3 bg-blue-500 flex justify-center items-center rounded-sm text-white text-sm gap-2">
                                ADD TO CART
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </button>
                            <a href="{{ route('user.checkout.index', ['product' => $product->slug]) }}"
                                class="py-2 px-4 border-2 border-blue-500 flex justify-center items-center rounded-sm text-blue-500 text-sm gap-2">
                                BUY NOW
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="py-3 px-3 bg-blue-500 flex justify-center items-center rounded-sm text-white text-sm gap-2">
                                ADD TO CART
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </a>
                            <a href="{{ route('login') }}"
                                class="py-2 px-4 border-2 border-blue-500 flex justify-center items-center rounded-sm text-blue-500 text-sm gap-2">
                                BUY NOW
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="pe-5">
                <div class="border md:mb-10 mb-5 p-5">
                    <h5 class="text-md font-semibold text-slate-800">Description</h5>
                    <p class="tracking-tighter text-sm text-slate-700">
                        {{ $product->description_product }}
                    </p>
                </div>

                <section class="bg-white py-8 lg:py-16 antialiased">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900">
                            Reviews
                        </h2>
                    </div>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf <!-- Tambahkan CSRF token untuk keamanan -->

                        <!-- Pilih Bintang -->
                        <div class="mb-5 flex gap-1" id="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <label for="star_{{ $i }}">
                                    <input type="radio" name="rating" id="star_{{ $i }}"
                                        value="{{ $i }}" class="hidden" required />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-5 h-5 star-icon text-gray-300" data-star="{{ $i }}"
                                        viewBox="0 0 24 24" stroke="none">
                                        <path
                                            d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                        </path>
                                    </svg>
                                </label>
                            @endfor
                        </div>

                        <!-- Komentar -->
                        <div class="py-2 px-4 mb-3 bg-white rounded-lg border border-gray-200">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" name="comment" rows="6" required
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                                placeholder="Write a comment..."></textarea>
                        </div>

                        <!-- ID Produk -->
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Kirim -->
                        <div class="mb-3">
                            <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                Send
                            </button>
                        </div>
                    </form>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @forelse ($reviews as $review)
                            <!-- Use $reviews instead of $product->reviews -->
                            <article class="p-6 text-base bg-white rounded-lg border border-gray-200 ">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <div class="flex items-center mr-3 gap-3 text-sm text-gray-900 font-semibold">
                                            @if ($review->user->image)
                                                <img src="{{ asset('storage/' . $review->user->image) }}"
                                                    alt="Profile Picture" class="mr-2 w-8 h-8 rounded-full">
                                            @else
                                                <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                                    alt="Default Profile Picture" class="mr-2 w-8 h-8 rounded-full">
                                            @endif
                                            <div>
                                                {{ $review->user->name }}
                                                <div class="flex items-center space-x-1 mb-2">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="w-4 h-4 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            viewBox="0 0 24 24" stroke="none">
                                                            <path
                                                                d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                            </path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            <time pubdate datetime="{{ $review->created_at }}"
                                                title="{{ $review->created_at->format('F d, Y') }}">
                                                {{ $review->created_at->diffForHumans() }}
                                            </time>
                                        </p>
                                    </div>
                                </footer>
                                <p class="text-gray-500">
                                    {{ $review->comment }}
                                </p>
                            </article>
                        @empty
                            <p>Tidak ada komentar</p>
                        @endforelse
                    </div>

                    <div class="mt-10">
                        <h3 class="text-xl font-semibold mb-4">Produk Terkait</h3>
                        <div class="grid md:grid-cols-4 grid-cols-2 gap-5 pe-5">
                            @foreach ($relatedProducts as $item)
                                <div class="border-2 py-3 px-2 flex flex-col justify-between">
                                    <a href="{{ route('page.productshow', $item->slug) }}"
                                        class="font-medium text-slate-800 text-sm tracking-tighter">
                                        {{ $item->name_product }} <!-- Tampilkan nama produk -->
                                    </a>
                                    <a href="{{ route('page.productshow', $item->slug) }}"
                                        class="flex justify-center items-center bg-center bg-contain overflow-hidden mx-auto mb-4">
                                        @if ($item->image_product)
                                            <img src="{{ asset('storage/' . $item->image_product) }}"
                                                alt="Product Image" class="object-cover w-32 h-32" />
                                        @else
                                            <img src="{{ asset('img/img-carousel-promo/laptop.jpg') }}"
                                                alt="Default Image" class="object-cover w-32 h-32" />
                                        @endif
                                    </a>

                                    <div class="flex items-center space-x-1 mb-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 {{ $i < round($item->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                viewBox="0 0 24 24" stroke="none">
                                                <path
                                                    d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                </path>
                                            </svg>
                                        @endfor
                                        <span class="text-sm text-slate-600">
                                            {{ isset($relatedReviewsCount[$item->id]) ? $relatedReviewsCount[$item->id] : 0 }}
                                            reviews
                                        </span>
                                    </div>

                                    <div class="md:flex justify-between">
                                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                                            Rp {{ number_format($item->price_product, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <x-list-cart-script />

    <script>
        const carts = document.getElementById("carts");
        carts.addEventListener("click", () => {
            const closeCart = document.getElementById("close-cart");
            const listCart = document.getElementById("list-cart");
            listCart.classList.remove("hidden");

            closeCart.addEventListener("click", () => {
                listCart.classList.add("hidden");
            });

            listCart.addEventListener("click", (e) => {
                // Periksa apakah target bukan bagian dari 'cart-content' atau tombol 'close-cart'
                if (!e.target.closest("#cart-content")) {
                    listCart.classList.add("hidden");
                }
            });
        });

        const hamburger = document.getElementById("hamburger");
        hamburger.addEventListener("click", () => {
            const closeMenu = document.getElementById("close-menu");
            const listMenu = document.getElementById("list-menu");
            listMenu.classList.remove("hidden");

            closeMenu.addEventListener("click", () => {
                listMenu.classList.add("hidden");
            });

            listMenu.addEventListener("click", (e) => {
                if (!e.target.closest("#menu-content")) {
                    listMenu.classList.add("hidden");
                }
            });
        });
    </script>

    <script>
        const filter = document.getElementById("filter");
        filter.addEventListener("click", () => {
            const closeFilter = document.getElementById("close-filter");
            const filterView = document.getElementById("filter-view");
            filterView.classList.remove("hidden");

            closeFilter.addEventListener("click", () => {
                filterView.classList.add("hidden");
            });

            filterView.addEventListener("click", (e) => {
                if (!e.target.closest("#filter-content")) {
                    filterView.classList.add("hidden");
                }
            });
        });
    </script>

    <script>
        const radios = document.querySelectorAll('input[name="bintang"]');

        radios.forEach((radio) => {
            radio.addEventListener("change", (e) => {
                const selectedRating = parseInt(e.target.id.split("_")[1]);
                const previousStars = document.querySelectorAll(
                    `label[for^="start_"] svg`
                );
                previousStars.forEach((star, index) => {
                    if (index < selectedRating) {
                        star.classList.add("fill-yellow-500");
                    } else {
                        star.classList.remove("fill-yellow-500");
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('star-rating').addEventListener('click', function(event) {
            // Cari elemen SVG yang diklik
            const clickedStar = event.target.closest('svg');

            if (clickedStar) {
                // Ambil nilai bintang yang dipilih
                const selectedStarValue = clickedStar.getAttribute('data-star');

                // Dapatkan semua ikon bintang
                const starIcons = document.querySelectorAll('.star-icon');

                // Reset warna semua bintang ke gray-300
                starIcons.forEach(icon => {
                    icon.classList.remove('text-yellow-500');
                    icon.classList.add('text-gray-300');
                });

                // Warnai bintang dari 1 hingga nilai yang dipilih
                for (let i = 0; i < selectedStarValue; i++) {
                    starIcons[i].classList.remove('text-gray-300');
                    starIcons[i].classList.add('text-yellow-500');
                }
            }
        });

        // Pastikan bintang selalu dimulai dari gray-300
        document.addEventListener('DOMContentLoaded', () => {
            const starIcons = document.querySelectorAll('.star-icon');
            starIcons.forEach(icon => {
                icon.classList.remove('text-yellow-500');
                icon.classList.add('text-gray-300');
            });
        });
    </script>

    <style>
        .star-icon {
            transition: fill 0.2s ease;
            cursor: pointer;
        }
    </style>

</body>

</html>
