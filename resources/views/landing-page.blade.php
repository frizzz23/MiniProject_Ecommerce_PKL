@extends('layouts.page')

@section('title')
    @guest
        Landing Page
    @endguest

    @auth
        Home Page
    @endauth 
@endsection

@section('main')
    <!-- Carousel Container -->
    <div class="flex flex-wrap lg:flex-nowrap gap-1">
        <!-- Primary Carousel -->
        <div class="flex-1 w-full lg:w-2/3">
            <div id="gallery" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-60 overflow-hidden rounded-lg">
                    @foreach ($products as $product)
                        @if ($loop->first)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                <img src="{{ asset('storage/' . $product->image_product) }}"
                                    class="absolute block w-full h-full object-cover" alt="Image 2">
                            </div>
                        @else
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ asset('storage/' . $product->image_product) }}"
                                    class="absolute block w-full h-full object-cover" alt="Image 2">
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100/50 group-hover:bg-gray-300/50">
                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
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
                                <img class=" rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                    alt="product image" src="{{ asset('storage/' . $product->image_product) }}" />
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
                                @if ($product->image_product)
                                    <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                        src="{{ asset('storage/' . $product->image_product) }}" alt="product image" />
                                @else
                                    <img class="rounded-t-lg object-cover transition duration-500 group-hover:scale-105 mt-7"
                                        src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="product image" />
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
                                            @endif @endauth
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


    <script>
        function showAlert(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: icon,
                title: message
            });
        }
    </script>


    @auth
        <script>
            function listCart(data) {
                let items = ''
                const cartItems = document.getElementById('cartItems');
                const totalAmount = document.getElementById('totalAmount');
                let amount = 0;
                data.forEach(item => {
                    amount += item.product.price_product * item.quantity;
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
                <button onclick="deleteCart('${item.id}')"
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
                totalAmount.innerHTML = `
                    <!-- Cart Total -->
     <div class="grid grid-cols-2 py-3">
         <p class="text-sm font-semibold text-gray-900 dark:text-white">Total</p>
         <p class="text-sm font-semibold text-gray-900 dark:text-white">Rp. ${amount.toLocaleString()}</p>
         </div>
                `
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
                        showAlert('success', 'product ditambahkan ke keranjang')
                        listCart(data);
                    } else {
                        showAlert('error', 'product gagal ditambahkan ke keranjang')
                    }
                }

                async function deleteCart(id_cart) {
                    Swal.fire({
                        title: "Yakin?",
                        text: "kamu yakin ingin menghapus keranjang ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            const api = await fetch('/api/cart/' + id_cart, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                }
                            });
                            const response = await api.json();

                            if (response.status == 'success') {
                                const data = await response.data;
                                showAlert('success', 'keranjang berhasil dihapus')
                                listCart(data);
                            } else {
                                showAlert('error', 'keranjang gagal dihapus')
                            }

                            Swal.fire({
                                title: "terhapus!",
                                text: "keranjang berhasil dihapus",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "tutup"
                            });
                        }
                    });

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
                    showAlert('error', 'keranjang gagal diload')
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
@endsection
