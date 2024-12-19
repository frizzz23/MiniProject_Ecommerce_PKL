@extends('layouts.user')
@section('main')
    <style>
        * {
            /* border: 1px solid black; */
        }
    </style>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="flex items-center">
                <a href="{{ route('landing-page') }}"
                    class="flex justify-center  items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-1.5 px-2 rounded-md">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                        </g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6.49996 7C7.96131 5.53865 9.5935 4.41899 10.6975 3.74088C11.5021 3.24665 12.4978 3.24665 13.3024 3.74088C14.4064 4.41899 16.0386 5.53865 17.5 7C20.6683 10.1684 20.5 12 20.5 15C20.5 16.4098 20.3895 17.5988 20.2725 18.4632C20.1493 19.3726 19.3561 20 18.4384 20H17C15.8954 20 15 19.1046 15 18V16C15 15.2043 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87864 13.8787C9.31603 14.4413 8.99996 15.2043 8.99996 16V18C8.99996 19.1046 8.10453 20 6.99996 20H5.56152C4.64378 20 3.85061 19.3726 3.72745 18.4631C3.61039 17.5988 3.49997 16.4098 3.49997 15C3.49997 12 3.33157 10.1684 6.49996 7Z"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span class="font-semibold text-xs"> Beranda</span>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class=" h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="m9 5 7 7-7 7" />
                    </svg>
                    <a href=""
                        class="flex justify-center ml-2 items-end gap-1  bg-white shadow-sm text-slate-800  w-auto py-2 px-2 rounded-md">
                        <span class="font-semibold text-xs"> Akun</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class=" h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="m9 5 7 7-7 7" />
                    </svg>
                    <a href="{{ route('user.carts.index') }}"
                        class="flex justify-center ml-2 items-end gap-1  bg-white shadow-sm text-slate-800 w-auto py-2 px-2 rounded-md">
                        <span class="font-semibold text-xs">Pesanan</span>
                    </a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="flex flex-col justify-center items-start bg-white py-3 px-4 rounded-lg mt-4 mb-1 shadow-sm">
        <h2 class=" text-xl font-semibold text-gray-800 ">Pesanan Saya </h2>
        <p class="text-muted small">
            Pantau riwayat pesanan Anda beserta statusnya, seperti Pending, Diproses, Selesai, atau Dibatalkan, untuk
            memastikan semuanya sesuai dengan kebutuhan Anda.
        </p>
    </div>
    <div class="mt-4">
        <div class="flex items-center">
            <div x-data="{ openTab: 1 }" class="w-full">
                <div class="mb-2 bg-white shadow-sm rounded-lg p-2 text-md">
                    <button x-on:click="openTab = 1"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                1,
                            'border-b-2 border-transparent text-gray-700': openTab !== 1
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Menunggu
                    </button>
                    <button x-on:click="openTab = 2"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                2,
                            'border-b-2 border-transparent text-gray-700': openTab !== 2
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Proses
                    </button>
                    <button x-on:click="openTab = 3"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                3,
                            'border-b-2 border-transparent text-gray-700': openTab !== 3
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Selesai
                    </button>
                </div>

                <!-- Tab 1 - Menunggu -->
                <div x-show="openTab === 1">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'pending')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                @foreach ($order->productOrders as $productOrder)
                                    <!-- Gambar Produk -->
                                    <div class="flex gap-2 mb-3">
                                        <div
                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                alt="{{ $productOrder->product->name_product }}" class="object-contain" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-semibold text-slate-800">{{ $productOrder->product->name_product }}</span>
                                            <span class="text-xs text-slate-500">x{{ $productOrder->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Keterangan Produk -->
                                @endforeach
                                <div class="text-slate-700 text-sm grid grid-cols-[0.5fr_2fr]">
                                    <div class="flex items-end">
                                        <a href="{{ route('order-show', ['order_id' => $order->id]) }}"
                                            class="bg-blue-700 text-white rounded-lg px-5 py-2 text-sm">Detail
                                        </a>
                                    </div>
                                    <div class="flex justify-end">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class=" text-right">Subtotal Produk </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Pengiriman </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">+</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Diskon </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">-</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Total </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                <!-- Baris ketiga (total harga) -->
                                <div class="flex justify-end gap-2 items-center px-3">
                                    <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                    <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white px-3 rounded-md w-full">
                                <p class="text-slate-700 text-sm font-semibold text-center py-10"> Tidak ada pesanan yang
                                    sedang menunggu.</p>
                            </div>
                        @endforelse
                    </div>
                </div>



                <!-- Tab 2 - Proses -->
                <div x-show="openTab === 2">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'processing')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                @foreach ($order->productOrders as $productOrder)
                                    <!-- Gambar Produk -->
                                    <div class="flex gap-2 mb-3">
                                        <div
                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                alt="{{ $productOrder->product->name_product }}"
                                                class="object-contain" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-semibold text-slate-800">{{ $productOrder->product->name_product }}</span>
                                            <span class="text-xs text-slate-500">x{{ $productOrder->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Keterangan Produk -->
                                @endforeach
                                <div class="text-slate-700 text-sm grid grid-cols-[0.5fr_2fr]">
                                    <div class="flex items-end">
                                        <a href="{{ route('order-show', ['order_id' => $order->id]) }}"
                                            class="bg-blue-700 text-white rounded-lg px-5 py-2 text-sm">Detail
                                        </a>
                                    </div>
                                    <div class="flex justify-end">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class=" text-right">Subtotal Produk </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Pengiriman </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">+</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Diskon </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">-</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Total </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                <!-- Baris ketiga (total harga) -->
                                <div class="flex justify-end gap-2 items-center px-3">
                                    <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                    <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white px-3 rounded-md w-full">
                                <p class="text-slate-700 text-sm font-semibold text-center py-10">Tidak ada pesanan yang
                                    sedang diproses.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 3 - Selesai -->
                <div x-show="openTab === 3">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'completed')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                @foreach ($order->productOrders as $productOrder)
                                    <!-- Gambar Produk -->
                                    <div class="flex gap-2 mb-3">
                                        <div
                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                alt="{{ $productOrder->product->name_product }}"
                                                class="object-contain" />
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-semibold text-slate-800">{{ $productOrder->product->name_product }}</span>
                                            <span class="text-xs text-slate-500">x{{ $productOrder->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Keterangan Produk -->
                                @endforeach
                                <div class="text-slate-700 text-sm grid grid-cols-[0.5fr_2fr]">
                                    <div class="flex items-end gap-2">
                                        <a href="{{ route('order-show', ['order_id' => $order->id]) }}"
                                            class="bg-blue-700 text-white rounded-lg px-5 py-2 text-sm">Detail
                                        </a>
                                    </div>
                                    <div class="flex justify-end">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class=" text-right">Subtotal Produk </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Pengiriman </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">+</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Diskon </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center">-</td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class=" text-right">Total </td>
                                                    <td class=" px-2 text-center">:</td>
                                                    <td class="text-center"></td>
                                                    <td class=" text-left">Rp.
                                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">
                                <!-- Baris ketiga (total harga) -->
                                <div class="flex justify-end gap-2 items-center px-3">
                                    <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                    <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white px-3 rounded-md w-full">
                                <p class="text-slate-700 text-sm font-semibold text-center py-10">Tidak ada pesanan yang
                                    sudah selesai.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
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

        function minus(id) {
            const input = document.getElementById(id);
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function plus(id, max) {
            const input = document.getElementById(id);
            if (input.value < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
    </script>
@endsection
