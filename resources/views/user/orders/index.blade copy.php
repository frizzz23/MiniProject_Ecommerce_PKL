@extends('layouts.user')
@section('main')
    <div class="mt-10 px-10">
        <!-- component -->
        <div class="flex items-center">
            <div x-data="{ openTab: 1 }" class="w-full">
                <div class="mb-2 space-x-2 flex p-2 bg-white rounded-lg shadow-md bg-white mx-8">
                    <button x-on:click="openTab = 1"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab === 1,
                            'border-b-2 border-transparent text-gray-700': openTab !== 1
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Menunggu
                    </button>
                    <button x-on:click="openTab = 2"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab === 2,
                            'border-b-2 border-transparent text-gray-700': openTab !== 2
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        proses
                    </button>
                    <button x-on:click="openTab = 3"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab === 3,
                            'border-b-2 border-transparent text-gray-700': openTab !== 3
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Selesai
                    </button>
                </div>

                <!-- tap 1 -->
                <div x-show="openTab === 1">
                    <table class="table-auto w-full border-spacing-8 border-separate">
                        @forelse ($userOrders->where('status_order', 'pending') as $order)
                            <tr class="bg-white px-3 rounded-md w-full">
                                <td>
                                    <table class="table-auto w-full">
                                        @foreach ($order->productOrders as $productOrder)
                                            <tr class="">
                                                <td class="text-slate-700 text-sm text-medium">
                                                    <div class="flex gap-1 flex-wrap items-center">
                                                        <div
                                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center ">
                                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                                alt="{{ $productOrder->product->name_product }}"
                                                                class="object-contain" />
                                                        </div>
                                                        <div>
                                                            {{ $productOrder->product->name_product }}
                                                            <br />
                                                            <span
                                                                class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-700 text-sm text-medium py-1">
                                                    Rp.
                                                    {{ number_format($productOrder->product->price_product * $productOrder->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-slate-700 text-md py-5">
                                                <div class="md:flex justify-between items-center md:px-10 ">
                                                    <p class="text-sm font-medium tracking-tighter">
                                                        {{ $order->created_at->translatedFormat('d F Y') }}
                                                    </p>
                                                    <p class="text-slate-700 font-semibold "> Rp.
                                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white px-3 rounded-md w-full">
                                <th class="text-slate-700 text-sm text-semibold text-center py-10">Tidak ada pesanan
                                    yang sedang
                                    menunggu.
                                </th>
                            </tr>
                        @endforelse
                    </table>
                </div>

                <!-- tap 2 -->
                <div x-show="openTab === 2">
                    <table class="table-auto w-full border-spacing-8 border-separate">
                        @forelse ($userOrders->where('status_order', 'processing') as $order)
                            <tr class="bg-white px-3 rounded-md w-full">
                                <td>
                                    <table class="table-auto w-full">
                                        @foreach ($order->productOrders as $productOrder)
                                            <tr class="">
                                                <td class="text-slate-700 text-sm text-medium">
                                                    <div class="flex gap-1 flex-wrap items-center">
                                                        <div
                                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center ">
                                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                                alt="{{ $productOrder->product->name_product }}"
                                                                class="object-contain" />
                                                        </div>
                                                        <div>
                                                            {{ $productOrder->product->name_product }}
                                                            <br />
                                                            <span
                                                                class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-700 text-sm text-medium py-1">
                                                    Rp.
                                                    {{ number_format($productOrder->product->price_product * $productOrder->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-slate-700 text-md py-5">
                                                <div class="md:flex justify-between items-center md:px-10 ">
                                                    <p class="text-sm font-medium tracking-tighter">
                                                        {{ $order->created_at->translatedFormat('d F Y') }}
                                                    </p>
                                                    <p class="text-slate-700 font-semibold "> Rp.
                                                        {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white px-3 rounded-md w-full">
                                <th class="text-slate-700 text-sm text-semibold text-center py-10">Tidak ada pesanan
                                    yang sedang proses.
                                </th>
                            </tr>
                        @endforelse
                    </table>
                </div>

                <!-- tap 3 -->
                <div x-show="openTab === 3">
                    <table class="table-auto w-full border-spacing-8 border-separate">
                        @forelse ($userOrders->where('status_order', 'completed') as $order)
                            <tr class="bg-white px-3 rounded-md w-full">
                                <td>
                                    <table class="table-auto w-full">
                                        @foreach ($order->productOrders as $productOrder)
                                            <tr class="">
                                                <td class="text-slate-700 text-sm text-medium">
                                                    <div class="flex gap-1 flex-wrap items-center">
                                                        <div
                                                            class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center ">
                                                            <img src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                                alt="{{ $productOrder->product->name_product }}"
                                                                class="object-contain" />
                                                        </div>
                                                        <div>
                                                            {{ $productOrder->product->name_product }}
                                                            <br />
                                                            <span
                                                                class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-700 text-sm text-medium py-1">
                                                    Rp.
                                                    {{ number_format($productOrder->product->price_product * $productOrder->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-slate-700 text-md py-5">
                                                <div class="md:flex justify-between items-center md:px-10 ">
                                                    <p class="text-sm font-medium tracking-tighter">
                                                        {{ $order->created_at->translatedFormat('d F Y') }}
                                                    </p>
                                                    <div class="text-slate-700 font-semibold ">
                                                        <p>
                                                            Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </p>
                                                        <button
                                                            class="block w-full text-white py-1.5 px-4 rounded-md bg-blue-500">Nilai</button>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white px-3 rounded-md w-full">
                                <th class="text-slate-700 text-sm text-semibold text-center py-10">Tidak ada pesanan
                                    yang sedang
                                    kedaluarsa.
                                </th>
                            </tr>
                        @endforelse
                    </table>
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