@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="w-full">

                <div class="bg-white p-4 rounded-lg  shadow-sm border relative mb-10">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold text-center mb-4 ">Detail Produk</h1>

                    <!-- Gambar Produk (Awalnya disembunyikan) -->
                    <div class="relative mb-4 hidden flex justify-center transition-all duration-500 opacity-0 transform scale-75"
                        id="productImageContainer">
                        @if ($product->image_product)
                            <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}"
                                class="w-[50%] h-[50%] object-cover rounded-lg" id="productImage"
                                data-height="{{ $product->image_product_height }}">
                        @else
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                class="w-[50%] h-[50%] object-cover rounded-lg" id="productImage">
                        @endif
                    </div>

                    <!-- Tombol Dropdown untuk Menampilkan Gambar (Di tengah bawah card) -->
                    <div class="absolute bottom-[-50px] left-1/2 transform -translate-x-1/2 mb-4  rounded-full ">
                        <button id="dropdownButton"
                            class="bg-gray-800 text-white p-3 rounded-full shadow-lg hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="w-5 h-5" id="dropdownIcon">
                                <!-- Ikow-5 h-5 n dropdown default (panah turun) -->
                                <path id="dropdownPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Gambar dan Detail Produk -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Kolom Keterangan Produk (Card 1) dengan lebar 70% -->
                    <div class="bg-white p-4 rounded-lg  border lg:col-span-2">
                        <!-- Nama Produk -->
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4">{{ $product->name_product ?? '-' }}</h3>

                        <!-- Rating dan Reviews -->
                        <div class="flex items-center space-x-2 mb-4">
                            <!-- Bintang Rating -->
                            <div class="flex items-center space-x-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-5 h-5 {{ $i < round($product->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        viewBox="0 0 24 24" stroke="none">
                                        <path
                                            d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                            <!-- Total Reviews -->
                            <span class="text-sm text-slate-600">{{ $product->reviews_count ?? 0 }} reviews</span>
                        </div>
                        <!-- Harga Produk -->
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-lg font-semibold text-gray-800">Harga</span>
                            <span class="text-lg font-medium text-gray-700">:</span>
                            <span class="text-xl font-bold text-blue-500">Rp
                                {{ number_format($product->price_product, 0, ',', '.') }}</span>
                        </div>

                        <!-- Kategori Brand Stok-->
                        <div class="flex space-x-8 mb-2">
                            <!-- Stok Column -->
                            <div class="flex-col w-1/3 mb-4">
                                <div class="text-xs font-semibold text-gray-500 mb-1">Stok</div>
                                <div class="flex border justify-start items-center w-full rounded-md p-3">
                                    <!-- Lingkaran warna -->
                                    <div
                                        class="w-4 h-4 rounded-full mr-2 
                                    {{ $product->stock_product == 0
                                        ? 'bg-gray-500'
                                        : ($product->stock_product <= 10
                                            ? 'bg-red-600'
                                            : ($product->stock_product <= 50
                                                ? 'bg-yellow-500'
                                                : 'bg-green-500')) }}">
                                    </div>
                                    <!-- Jumlah stok -->
                                    <div class="text-sm font-medium text-gray-700">
                                        <span class="font-semibold">
                                            {{ $product->stock_product == 0 ? 'Habis' : $product->stock_product . ' unit' }}
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <!-- Kategori Column -->
                            <div class="flex-col w-1/3">
                                <div class="text-xs font-semibold text-gray-500 mb-1">Kategori</div>
                                <div class="flex border justify-center items-center w-full rounded-md p-3">
                                    <span
                                        class="text-sm font-medium text-gray-700">{{ $product->category->name_category }}</span>
                                </div>
                            </div>

                            <!-- Brand Column -->
                            <div class="flex-col w-1/3">
                                <div class="text-xs font-semibold text-gray-500 mb-1">Brand</div>
                                <div class="flex border justify-center items-center w-full rounded-md p-3">
                                    <span
                                        class="text-sm font-medium text-gray-700">{{ $product->brand->name_brand }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="flex-col mb-2">
                            <div class="text-xs font-semibold text-gray-500 mb-1">Deskripsi</div>
                            <div class="flex border justify-start items-center w-full rounded-md p-3">
                                <p class="text-sm text-gray-700">{!! nl2br(e($product->description_product)) !!}</p>
                            </div>
                        </div>


                    </div>


                    <!-- Kolom Waktu Create dan Update (Card 2) dengan lebar 30% -->
                    <div
                        class="h-96 bg-gradient-to-r from-blue-800 to-blue-400 p-4 rounded-lg shadow-sm border lg:col-span-1 flex flex-col">
                        <h3 class="text-lg font-semibold my-1 text-white">Informasi</h3>
                        <div class="text-sm text-white">
                            <h4 class="font-semibold text-gray-200 my-2">Status Stok</h4>
                            <div
                                class="bg-white shadow-md rounded-md p-3  flex justify-between items-center gap-2 text-sm font-medium text-gray-700">
                                <!-- Card 1 - Merah -->
                                <div class="flex items-center">
                                    <div class="w-5 h-5 rounded-full bg-red-600 mr-2"></div>
                                    <span class="text-sm font-semibold text-red-600">Sedikit</span>
                                </div>

                                <!-- Card 2 - Kuning -->
                                <div class="flex items-center">
                                    <div class="w-5 h-5 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm font-semibold text-yellow-500">Cukup</span>
                                </div>

                                <!-- Card 3 - Hijau -->
                                <div class="flex items-center">
                                    <div class="w-5 h-5 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm font-semibold text-green-500">Aman</span>
                                </div>
                            </div>
                        </div>


                        <div class="text-sm text-white">
                            <h4 class="font-semibold text-gray-200 my-2">Waktu</h4>
                            <div class="flex gap-4">
                                <!-- Card Dibuat -->
                                <div class="bg-white shadow-md rounded-md p-3 w-full sm:w-auto">
                                    <div class="text-xs font-semibold text-gray-500 mb-1">Dibuat</div>
                                    <div class="text-sm font-medium text-gray-700">
                                        <span
                                            class="font-semibold">{{ $product->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>

                                <!-- Card Diupdate -->
                                <div class="bg-white shadow-md rounded-md p-3 w-full sm:w-auto">
                                    <div class="text-xs font-semibold text-gray-500 mb-1">Diupdate</div>
                                    <div class="text-sm font-medium text-gray-700">
                                        <span
                                            class="font-semibold">{{ $product->updated_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Kembali -->
            <div class="mt-6 text-start">
                <a href="{{ route('admin.products.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow-md">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menampilkan Gambar dan Mengubah Ikon dengan Transisi -->
    <script>
        // Fungsi untuk toggle visibility gambar dan mengubah ikon dropdown
        document.getElementById('dropdownButton').addEventListener('click', function() {
            const imageContainer = document.getElementById('productImageContainer');
            const dropdownIcon = document.getElementById('dropdownIcon');
            const dropdownPath = document.getElementById('dropdownPath');

            // Tampilkan gambar dengan transisi
            imageContainer.classList.toggle('hidden');
            imageContainer.classList.toggle('opacity-0');
            imageContainer.classList.toggle('opacity-100');
            imageContainer.classList.toggle('scale-75');
            imageContainer.classList.toggle('scale-100');

            // Cek jika gambar sedang ditampilkan
            const isImageVisible = !imageContainer.classList.contains('hidden');

            // Ubah ikon berdasarkan status gambar
            if (isImageVisible) {
                // Ganti ikon ke dropup (panah ke atas)
                dropdownPath.setAttribute('d', 'M19 15l-7-7-7 7'); // Panah ke atas
            } else {
                // Kembalikan ikon ke dropdown (panah ke bawah)
                dropdownPath.setAttribute('d', 'M19 9l-7 7-7-7'); // Panah ke bawah
            }
        });

        // Menutup dropdown saat klik di luar area dropdown
        document.addEventListener('click', function(event) {
            const dropdownButton = document.getElementById('dropdownButton');
            const imageContainer = document.getElementById('productImageContainer');

            // Cek jika klik bukan di dropdown atau tombol
            if (!dropdownButton.contains(event.target) && !imageContainer.contains(event.target)) {
                imageContainer.classList.add('hidden');
                const dropdownPath = document.getElementById('dropdownPath');
                dropdownPath.setAttribute('d', 'M19 9l-7 7-7-7'); // Kembalikan ikon ke posisi default (dropdown)
            }
        });
    </script>
@endsection
