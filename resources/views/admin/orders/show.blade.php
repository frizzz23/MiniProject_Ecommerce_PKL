@extends('layouts.admin')

@section('main')
    {{-- <style>
        * {
            border: 1px solid black;
        }
    </style> --}}
    <div class="container-fluid">
        <div class="container p-6">
            <div class="w-full">

                <div class="bg-white p-4 rounded-lg shadow-sm border mb-3">
                    <!-- Judul -->
                    <div class=" flex justify-between items-center p-2 ">
                        <div class="flex items-center justify-center  gap-2">
                            <h1 class="text-2xl font-bold  ">Detail Order</h1>
                        </div>


                        <div class="flex items-center justify-center text-center gap-2 ">
                            <span class="text-md font-semibold">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                            <div class="h-[25px] w-[2px] bg-gray-300"></div> <!-- Garis Vertikal -->
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold 
                                    @if ($order->status_order === 'completed') bg-green-200 text-green-600 
                                    @elseif ($order->status_order === 'processing') 
                                        bg-yellow-200 text-yellow-600 
                                    @elseif ($order->status_order === 'pending') 
                                        bg-blue-200 text-blue-600 
                                    @else 
                                        bg-gray-200 text-gray-600 @endif">
                                {{ ucfirst($order->status_order) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Baris Pertama: 3 Card -->
                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Alamat Pengiriman -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26c.54.36 1.25.36 1.8 0L21 8M5 19h14M8 10.8v9.2M16 10.8v9.2" />
                                </svg>
                                <h3 class="font-semibold text-lg text-blue-700">Alamat Pengiriman</h3>
                            </div>
                            <div class="mb-2">
                                <span class="font-medium">Alamat: </span>
                                <span>{{ $order->addresses->address }}</span>
                            </div>
                            <div>
                                <span class="font-medium">No Telp: </span>
                                <span>{{ $order->addresses->no_telepon }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Jasa Pengiriman -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a1 1 0 00-.293-.707l-3-3A1 1 0 0016 2H8a1 1 0 00-1 1v18a1 1 0 001 1h8a1 1 0 001-1v-6m5-3h-6M3 13h6m-6 4h6" />
                                </svg>
                                <h3 class="font-semibold text-lg text-blue-700">Jasa Pengiriman</h3>
                            </div>
                            <div>
                                <span class="font-medium">Ongkos Kirim: </span>
                                <span>+ Rp. {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Metode Pembayaran -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 14l6-6m0 0L9 8m6 6v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2h2" />
                                </svg>
                                <h3 class="font-semibold text-lg text-blue-700">Metode Pembayaran</h3>
                            </div>
                            <div class="mb-2">
                                <span class="font-medium">Metode Pembayaran: </span>
                                <span>{{ $order->payment->payment_method }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Status Pembayaran: </span>
                                <span>{{ $order->payment->status }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Baris Kedua: Produk yang Dipesan dan Total Harga -->
                    <div class="col-span-1 md:col-span-8 flex flex-col gap-6">
                        <!-- Produk yang Dipesan -->
                        <div class="card p-6 border rounded-lg shadow-md bg-white">
                            <h3 class="font-semibold text-lg mb-3">Produk yang Dipesan</h3>
                    
                            <!-- Grid untuk menampilkan produk per dua kolom -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($order->productOrders as $productOrder)
                                    <div class="flex items-center justify-start gap-1">
                                        <!-- Cek jika ada gambar produk -->
                                        @if ($productOrder->product->image_product)
                                            <img class="w-12 h-12 object-cover mr-4"
                                                 src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                 alt="{{ $productOrder->product->name_product }}">
                                        @else
                                            <img class="w-12 h-12 object-cover mr-4"
                                                 src="{{ asset('img/laptop.jpg') }}" alt="Gambar Default">
                                        @endif
                                        <div class="flex flex-col">
                                            <span>{{ $productOrder->product->name_product }}</span>
                                            <span class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-span-1 md:col-span-4 flex flex-col gap-6">
                        <!-- Total Harga -->
                        <div class="card p-6 border rounded-lg shadow-md bg-white">
                            <h3 class="font-semibold text-lg">Total Harga</h3>
                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                <span>Sub Total</span>
                                <span>:</span>
                                <span>Rp. {{ number_format($order->sub_total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                <span>Diskon</span>
                                <span>:</span>
                                <span>- Rp.
                                    {{ $order->promoCode?->discount_amount ? number_format($order->promoCode->discount_amount, 0, ',', '.') : '' }}</span>
                            </div>
                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                <span>Total</span>
                                <span>:</span>
                                <span>Rp. {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
