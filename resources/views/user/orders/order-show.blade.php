@extends('layouts.guest')
@section('content')
    <div class="grid md:grid-cols-2 grid-cols-1">
        <div class="bg-white min-h-screen">
            <div class="py-10 pt-2 px-20">
                <div class="mb-4">
                    <a href="{{ route('user.orders.index') }}"
                        class="bg-blue-400 text-white py-1 px-3 rounded-md text-xs">Kembali</a>
                </div>

                <div class="mb-7">
                    <h1 class="text-xl font-bold mb-1 text-slate-800">
                        Informasi Anda
                    </h1>

                    <div class="mb-3">
                        <input type="text" value="{{ $order->user->name }}" name="name" placeholder="Name"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            disabled />
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" value="{{ $order->user->email }}" placeholder="Email"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            readonly />
                    </div>
                    <div class="w-full border border-gray-300 rounded-lg overflow-hidden">
                        <div class="flex gap-5 border-b-2 py-2 px-3">
                            <input type="radio" name="alamat" id="alamat" checked disabled />
                            <label for="alamat" class="w-full">
                                <h6 class="text-lg text-slate-700 font-semibold">{{ $order->addresses->mark }}</h6>
                                <p class="text-sm text-slate-600">
                                    {{ $order->addresses->address }}
                                </p>
                                <span class="text-slate-700 text-sm font-medium">{{ $order->addresses->no_telepon }}</span>
                            </label>
                        </div>
                    </div>
                </div>



                <div class="mb-7">
                    <h1 class="text-xl font-bold mb-1 text-slate-800">
                        Pengiriman</h1>
                    <div class="mb-3">
                        <label for="courier" class="text-slate-700 font-medium text-sm">Kurir</label>
                        <input type="text" value="{{ $order->postage->code }}"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            disabled />
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="text-slate-700 font-medium text-sm">Service</label>
                        <input type="text" value="{{ $order->postage->service }}"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            disabled>
                    </div>

                </div>

                <div class="mb-7">
                    <h1 class="text-xl font-bold mb-1 text-slate-800">Voucher</h1>

                    <div class="flex items-center justify-center w-full border rounded-md overflow-hidden">
                        <input type="text" value="{{ $order->promoCode?->code }}"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            placeholder="Kode Voucher" disabled />
                    </div>
                </div>
                <div class="mb-7">
                    <h1 class="text-xl font-bold mb-1 text-slate-800">
                        pembayaran</h1>
                    <div class="mb-3">
                        <label class="text-slate-700 font-medium text-sm">Metode </label>
                        <input type="text" value="{{ $order->payment->payment_method }}"
                            class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                            disabled />
                    </div>
                    <div class="mb-3">
                        @if ($order->payment->status == 'pending')
                            <span
                                class="inline-flex items-center m-2 px-3 py-1 bg-blue-200  rounded-full text-sm font-semibold text-blue-600">Pending</span>
                        @elseif ($order->payment->status == 'failed')
                            <span
                                class="inline-flex items-center m-2 px-3 py-1 bg-red-200  rounded-full text-sm font-semibold text-red-600">Failed</span>
                        @elseif ($order->payment->status == 'expired')
                            <span
                                class="inline-flex items-center m-2 px-3 py-1 bg-yellow-200  rounded-full text-sm font-semibold text-yellow-600">Expired</span>
                        @else
                            <span
                                class="inline-flex items-center m-2 px-3 py-1 bg-green-200  rounded-full text-sm font-semibold text-green-600">Success</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div>
            <div class="md:fixed static top-0 bg-neutral-100 min-h-screen">
                <h5 class="px-20 text-2xl font-medium text-slate-800 py-5">
                    {{ count($order->productOrders) }} items
                </h5>
                <div class="px-10 h-96 overflow-y-auto">
                    <table class="table-auto w-full">
                        <tr class="sticky top-0 z-10">
                            <th class="text-slate-700 text-sm font-medium">Gambar</th>
                            <td class="text-slate-700 text-sm font-medium">Produk</td>
                            <td class="text-slate-700 text-sm font-medium">Harga</td>
                        </tr>
                        @foreach ($order->productOrders as $orderProduct)
                            <tr class="border-b-2 border-slate-300">
                                <th>
                                    <div
                                        class="w-28 h-28 bg-cover bg-center overflow-hidden flex justify-center items-center p-5">
                                        @if ($orderProduct->product->image_product)
                                            <img src="{{ asset('storage/' . $orderProduct->product->image_product) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="">
                                        @endif
                                    </div>
                                </th>
                                <td class="w-full align-bottom">
                                    <div class="text-sm text-slate-700 mb-5">
                                        {{ $orderProduct->product->name_product }}
                                        <br>
                                        <span>x {{ $orderProduct->quantity }}</span>
                                    </div>
                                </td>
                                <td class="align-center">
                                    <p class="text-sm text-slate-500 text-nowrap">
                                        Rp. {{ number_format($orderProduct->product->price_product, 0, ',', '.') }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="py-4 flex justify-between items-center mt-5 px-20">
                    <table class="table-auto w-full">
                        <tr>
                            <td class="text-xs text-slate-600 w-full">Subtotal</td>
                            <td class="text-xs text-slate-600 w-full"></td>
                            <td class="text-xs text-slate-800 text-right text-nowrap flex justify-end">
                                Rp. <div id="subtotal">{{ number_format($order->sub_total_amount, 0, ',', '.') }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs text-slate-600">Ongkos kirim</td>
                            <td class="text-xs text-slate-600">+</td>
                            <td class="text-xs text-slate-800 text-right text-nowrap">Rp.
                                {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-slate-600">Diskon</td>
                            <td class="text-xs text-slate-600">-</td>
                            <td class="text-xs text-slate-800 text-right text-nowrap">Rp.
                                {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm text-slate-600">Total</td>
                            <td class="text-sm text-slate-600"></td>
                            <td class="text-sm text-slate-800 text-right text-nowrap flex">
                                Rp. {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
