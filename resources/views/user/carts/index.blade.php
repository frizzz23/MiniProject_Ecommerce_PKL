@extends('layouts.user')


@section('main')
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse ml-[-30px]">
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
                        <span class="font-semibold text-xs">Keranjang</span>
                    </a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="flex flex-col justify-center items-start bg-white py-3 px-4 rounded-lg  mb-1 shadow-sm">
        <h2 class=" text-xl font-semibold text-gray-800 ">Keranjang Saya </h2>
        <p class="text-muted small">
            Lihat dan kelola produk yang Anda tambahkan ke keranjang sebelum melanjutkan ke pembayaran.
        </p>
    </div>

    <div class="mt-3">
        <div class="space-y-2">
            <!-- Heading -->
            <div class="bg-white shadow-sm rounded-lg p-4">
                <div class="grid grid-cols-[50px,2fr,1fr,1fr,1fr,auto] gap-4 items-center">
                    <!-- Check All Checkbox -->
                    <div class="text-slate-700 text-sm font-medium flex justify-center items-center ">
                        <div class="relative w-5 h-5">
                            <input type="checkbox" id="check_all" onclick="toggleAllCheckboxes(this)"
                                class="w-full h-full block peer appearance-none cursor-pointer border-2 border-blue-300 rounded-sm checked:bg-no-repeat checked:bg-center checked:border-blue-500 checked:bg-blue-100" />
                            <!-- SVG Icon -->
                            <svg class="absolute w-3 h-3 hidden peer-checked:block text-blue-500 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                style="user-select: none; pointer-events: none;" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>


                    </div>
                    <div class="text-slate-700 text-sm font-medium">Produk</div>
                    <div class="text-slate-700 text-sm font-medium">Harga</div>
                    <div class="text-slate-700 text-sm font-medium">Kuantitas</div>
                    <div class="text-slate-700 text-sm font-medium">Total</div>
                    <div class="text-slate-700 text-sm font-medium text-right">Action</div>
                </div>
            </div>

            <!-- List Data -->
            @php
                $total = 0;
            @endphp
            @forelse ($carts as $cart)
                @php
                    // $total += $cart->product->price_product * $cart->quantity;
                @endphp
                <div class="bg-white shadow-sm rounded-lg p-4 opacity-50" id="cart_{{ $cart->id }}">
                    <input type="hidden" name="total_input_{{ $cart->id }}" id="total_input_{{ $cart->id }}"
                        value="{{ $cart->product->price_product * $cart->quantity }}" />

                    <div class="grid grid-cols-[50px,2fr,1fr,1fr,1fr,auto] gap-4 items-center">
                        <!-- Checkbox -->
                        <div class="flex justify-center">
                            <label for="cart_input_{{ $cart->id }}" class="relative w-5 h-5">
                                <input type="checkbox" name="cart[]" value="{{ $cart->id }}"
                                    id="cart_input_{{ $cart->id }}"
                                    class="w-full h-full block peer appearance-none cursor-pointer border-2 border-blue-300 rounded-sm checked:bg-no-repeat checked:bg-center checked:border-blue-500 checked:bg-blue-100" />
                                <!-- SVG Icon -->
                                <svg class="absolute w-3 h-3 hidden peer-checked:block text-blue-500 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                    style="user-select: none;pointer-events: none;" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </label>
                        </div>

                        <!-- Produk -->
                        <div class="flex gap-2 items-center">
                            <div class="w-16 h-16 bg-cover bg-center overflow-hidden flex justify-center items-center">
                                @if ($cart->product->image_product)
                                    <img src="{{ asset('storage/' . $cart->product->image_product) }}" alt="Product"
                                        class="object-contain w-full h-full" />
                                @else
                                    <img src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="Product"
                                        class="object-contain w-full h-full" />
                                @endif
                            </div>
                            <span>{{ $cart->product->name_product }}</span>
                        </div>

                        <!-- Harga -->
                        <div class="text-slate-700 text-sm">
                            Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}
                        </div>

                        <!-- Kuantitas -->
                        <div>
                            <div class="flex border-2 border-blue-200 justify-between items-center w-24 rounded-md">
                                <button type="button" id="minus_{{ $cart->id }}" class="p-2"
                                    onclick="minus('quantity_{{ $cart->id }}', '{{ $cart->product->price_product }}', this)"
                                    disabled>
                                    -
                                </button>
                                <input type="text" class="w-full text-center outline-none p-2"
                                    value="{{ $cart->quantity }}" id="quantity_{{ $cart->id }}"
                                    data-price="{{ $cart->product->price_product }}" readonly />
                                <button type="button" id="plus_{{ $cart->id }}" class="p-2"
                                    onclick="plus('quantity_{{ $cart->id }}', {{ $cart->product->stock_product }}, '{{ $cart->product->price_product }}', this)"
                                    disabled>
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="text-slate-700 text-sm">
                            <span id="total_{{ $cart->id }}">
                                Rp. {{ number_format($cart->product->price_product * $cart->quantity, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Action -->
                        <div class="text-right">
                            <form action="{{ route('user.carts.destroy', $cart->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="delete" class="text-red-500 text-xs"
                                    onclick="confirmDelete(event, '{{ $cart->id }}', this)"
                                    disabled>
                                    Hapus
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                    <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan" class="w-64 h-64">
                    <p class="text-lg text-gray-600 font-medium">Keranjang Kosong</p>
                </div>
            @endforelse
        </div>

        <div class="bg-white shadow-sm rounded-lg p-4 mt-2">
            <div class="flex justify-between items-center mb-10">
                <div class="w-1/2">
                    <h4 class="text-md text-slate-600">Subtotal</h4>
                    <p class="text-xs text-slate-500">
                        Termasuk pajak dan Pengiriman dan pajak dihitung saat checkout.
                    </p>
                </div>

                <input type="hidden" name="total_input" id="total_input" value="{{ $total }}" />
                <div class="text-md text-slate-800 text-nowrap ">
                    {{-- <span id="total">Rp. {{ number_format($total, 0, ',', '.') }}</span> --}}
                    <span id="total">Rp. 0</span>
                </div>
            </div>

            <div class="flex justify-end">
                @if (count($carts) > 0)
                    <form action="{{ route('user.checkout.index') }}" method="get">
                        <input type="hidden" name="cart" id="cartForm" />
                        <button type="submit" id="cartSubmit"
                            class="bg-blue-200 text-white text-sm px-5 py-2 rounded-md" disabled>
                            Checkout
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);
        }

        document.addEventListener("DOMContentLoaded", () => {
            const carts = document.querySelectorAll("input[name='cart[]']"); // Checkbox untuk cart
            const totalInput = document.getElementById("total_input"); // Input total (hidden)
            const totalEl = document.getElementById("total"); // Elemen tampilan total harga
            const checkAll = document.getElementById("check_all"); // Checkbox "Check All"

            // Fungsi untuk memperbarui total harga
            const updateTotal = () => {
                let total = 0;
                let listCart = [];

                carts.forEach((cart) => {
                    const id = cart.value; // ID produk
                    const quantityInput = document.getElementById(`quantity_${id}`); // Kuantitas
                    const price = parseInt(quantityInput.dataset.price); // Harga per item
                    const quantity = parseInt(quantityInput.value); // Jumlah

                    if (cart.checked) {
                        total += price * quantity; // Tambahkan harga ke total
                        listCart.push(id); // Menambahkan id produk ke listCart
                        document.getElementById(`plus_${id}`).disabled = false;
                        document.getElementById(`minus_${id}`).disabled = false;
                        document.getElementById(`delete`).disabled = false;
                        document.getElementById(`cart_${id}`).classList.remove("opacity-50");
                    } else {
                        document.getElementById(`plus_${id}`).disabled = true;
                        document.getElementById(`minus_${id}`).disabled = true;
                        document.getElementById(`delete`).disabled = true;
                        document.getElementById(`cart_${id}`).classList.add("opacity-50");
                    }
                });

                if (total > 0) {
                    cartSubmit.disabled = false;
                    cartSubmit.classList.remove("bg-blue-200");
                    cartSubmit.classList.add("bg-blue-500");
                    cartForm.value = listCart.join('-');
                } else {
                    cartSubmit.disabled = true;
                    cartSubmit.classList.remove("bg-blue-500");
                    cartSubmit.classList.add("bg-blue-200");
                }

                // Perbarui input dan tampilan total
                totalInput.value = total;
                totalEl.textContent = formatRupiah(total);
            };

            // Fungsi untuk menandai atau membatalkan semua checkbox
            const toggleCheckAll = () => {
                const isChecked = checkAll.checked;
                carts.forEach((cart) => {
                    cart.checked = isChecked;
                });
                updateTotal();
            };

            // Tambahkan event listener pada setiap checkbox
            carts.forEach((cart) => {
                cart.addEventListener("change", updateTotal);
            });

            // Tambahkan event listener pada checkbox "Check All"
            if (checkAll) {
                checkAll.addEventListener("change", toggleCheckAll);
            }
        });

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

                    const total_input_id = parseInt(document.getElementById("total_input_" + id.split("_")[1]).value) -
                        parseInt(price);
                    document.getElementById("total_input_" + id.split("_")[1]).value = total_input_id
                    document.getElementById("total_" + id.split("_")[1]).innerHTML = formatRupiah(total_input_id);
                    total_input.value = parseInt(total_input.value) - parseInt(price);
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
                text: "Produk ini akan dihapus dari keranjang!",
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
                    Swal.fire({
                        toast: true,
                        position: 'top-end', // Pojok kanan atas
                        icon: 'success',
                        iconColor: '#3b82f6', // Biru-500 dari Tailwind CSS
                        title: 'Produk dihapus dari keranjang', // Pesan yang ingin ditampilkan
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        background: '#eff6ff', // Warna latar belakang biru muda
                    });

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
