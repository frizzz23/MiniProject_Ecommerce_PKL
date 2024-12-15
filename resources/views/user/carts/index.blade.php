@extends('layouts.user')

@section('main')
    <div class="">
        <div class="bg-white py-2 px-3 rounded-md">
            <table class="table-auto w-full">
                <thead class="border-b-2">
                    <tr>
                        <th class="text-slate-700 text-sm text-medium text-left py-2">
                            Product
                        </th>
                        <th class="text-slate-700 text-sm text-medium text-left py-2">
                            Price
                        </th>
                        <th class="text-slate-700 text-sm text-medium text-left py-2">
                            Quantity
                        </th>
                        <th class="text-slate-700 text-sm text-medium text-left py-2">
                            Total
                        </th>
                        <th class="text-slate-700 text-sm text-medium text-left py-2">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($carts as $cart)
                        @php
                            $total += $cart->product->price_product * $cart->quantity;
                        @endphp
                        <tr class="border-b-2" id="cart_{{ $cart->id }}">
                            <input type="hidden" name="total_input_{{ $cart->id }}"
                                id="total_input_{{ $cart->id }}"
                                value="{{ $cart->product->price_product * $cart->quantity }}" />
                            <td class="text-slate-700 text-sm text-medium py-2">
                                <div class="flex gap-1 flex-wrap items-center">
                                    <div
                                        class="w-28 h-28 bg-cover bg-center overflow-hidden flex justify-center items-center p-5">
                                        <img src="{{ asset('storage/' . $cart->product->image_product) }}" alt="Hp"
                                            class="object-contain" />
                                    </div>
                                    <span> {{ $cart->product->name_product }}</span>
                                </div>
                            </td>
                            <td class="text-slate-700 text-sm text-medium py-2">
                                Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}
                            </td>
                            <td class="text-slate-700 text-sm text-medium py-2">
                                <div
                                    class="flex border-2 border-blue-200 justify-between items-center w-24 rounded-md mb-4">
                                    <button type="button" class="p-2"
                                        onclick="minus('quantity_{{ $cart->id }}', '{{ $cart->product->price_product }}', this)">
                                        -
                                    </button>
                                    <input type="text" class="w-full text-center outline-none p-2"
                                        value="{{ $cart->quantity }}" id="quantity_{{ $cart->id }}" readonly />
                                    <button type="button" class="p-2"
                                        onclick="plus('quantity_{{ $cart->id }}', {{ $cart->product->stock_product }}, '{{ $cart->product->price_product }}', this)">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="text-slate-700 text-sm text-medium py-2">
                                <span id="total_{{ $cart->id }}">Rp.
                                    {{ number_format($cart->product->price_product * $cart->quantity, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-slate-700 text-sm text-medium py-2 align-bottom text-right">
                                <form action="{{ route('user.carts.destroy', $cart->id) }}" method="post" class="pe-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-xs"
                                        onclick="confirmDelete(event, '{{ $cart->id }}')">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5" class="text-center text-slate-700 text-sm py-10">Cart Not Found.
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="bg-gray-100 border-b-2 border-slate-200 pb-4 mt-2 p-5">
                <div class="flex justify-between items-center mb-10">
                    <div class="w-1/2">
                        <h4 class="text-md text-slate-600">Subtotal</h4>
                        <p class="text-xs text-slate-500">
                            Tax included and Shipping and taxes calculated at checkout.
                        </p>
                    </div>

                    <input type="hidden" name="total_input" id="total_input" value="{{ $total }}" />
                    <div class="text-md text-slate-800 text-nowrap ">
                        <span id="total">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    @if (count($carts) > 0)
                        <a href="{{ route('user.checkout.index') }}"
                            class="bg-blue-500 text-white text-sm px-5 py-2 rounded-md">
                            Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showAlert(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1000,
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


        const hamburger = document.getElementById("hamburger");
        if (hamburger) {
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
        }
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);
        }


        const total_input = document.getElementById("total_input"); // Mengambil input total
        const total = document.getElementById("total"); // Mengambil total

        async function minus(id, price, el) {
            el.disabled = true;
            const input = document.getElementById(id);
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                document.getElementById("total_" + id.split("_")[1]).innerHTML = 'loading..';
                total.innerHTML = 'loading..';

                const response = await fetch('/carts/' + id.split("_")[1], {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        quantity: input.value
                    })
                });


                // Cek jika respons JSON
                if (response.ok) {
                    const data = await response.json();
                    input.value = data.quantity;


                    total_input.value = parseInt(total_input.value) - parseInt(price);
                    const total_input_id = parseInt(document.getElementById("total_input_" + id.split("_")[1]).value) -
                        parseInt(price);
                    document.getElementById("total_input_" + id.split("_")[1]).value = total_input_id
                    document.getElementById("total_" + id.split("_")[1]).innerHTML = formatRupiah(total_input_id);
                    total.innerHTML = formatRupiah(total_input.value);

                } else {
                    console.error('Server error or invalid response:', response.status);
                    const text = await response.text();
                    console.error('Response text:', text);
                }






            }
            el.disabled = false;
        }

        async function plus(id, max, price, el) {
            el.disabled = true;
            const input = document.getElementById(id);
            if (input.value <= max) {
                input.value = parseInt(input.value) + 1;
                document.getElementById("total_" + id.split("_")[1]).innerHTML = 'loading..';
                total.innerHTML = 'loading..';

                const response = await fetch('/carts/' + id.split("_")[1], {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        quantity: input.value
                    })
                });


                // Cek jika respons JSON
                if (response.ok) {
                    const data = await response.json();
                    input.value = data.quantity;

                    total_input.value = parseInt(total_input.value) + parseInt(price);
                    const total_input_id = parseInt(document.getElementById("total_input_" + id.split("_")[1]).value) +
                        parseInt(price);
                    document.getElementById("total_input_" + id.split("_")[1]).value = total_input_id
                    document.getElementById("total_" + id.split("_")[1]).innerHTML = formatRupiah(total_input_id);
                    total.innerHTML = formatRupiah(total_input.value);

                } else {
                    console.error('Server error or invalid response:', response.status);
                    const text = await response.text();
                    console.error('Response text:', text);
                }

            } else {
                showAlert('error', 'stok product sudah habis')
            }
            el.disabled = false;
        }

        function confirmDelete(event, id) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: "Kamu Yakin?",
                text: "Item ini akan dihapus dari keranjang!",
                icon: "warning",
                iconColor: "#334155",
                width: 400,
                background: "#fff",
                showCancelButton: true,
                confirmButtonColor: "#334155",
                cancelButtonColor: "#b91c1c",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    showAlert('success', 'Item dihapus')
                    total.innerHTML = 'loading..';
                    document.getElementById("cart_" + id).classList.add("hidden");
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }
            });

        }
    </script>
@endsection
