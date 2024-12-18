z
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(number);
    }

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
    @auth

    let amount = 0;

    /* function listCart(data) {
        let items = ''
        const cartItems = document.getElementById('cartItems');
        data.forEach(item => {
            amount += item.product.price_product * item.quantity;
            items += `
              <tr class="border-b-2 border-slate-200 pb-4">
                    <th>
                        <div
                            class="w-28 h-28 bg-cover bg-center overflow-hidden flex justify-center items-center p-5">
                            <img src="{{ url('') }}/storage/${item.product.image_product}" alt="Hp" class="" />
                        </div>
                    </th>
                    <td class="w-full">
                        <p class="text-sm text-slate-700 mb-5">
                            ${item.product.name_product}
                        </p>
                        <p class="text-sm text-slate-500">${formatRupiah(item.product.price_product * item.quantity)}</p>
                    </td>
                    <td>
                        <div class="flex border-2 border-blue-200 rounded-md mb-4">
                            <button type="button" class="p-2" onclick="minus('quantity_${item.id}', ${item.product.price_product}, this)">
                                -
                            </button>
                            <input type="text" class="w-10 outline-none p-2 text-center" value="${item.quantity}"
                                id="quantity_${item.id}" readonly/>
                            <button type="button" class="p-2" onclick="plus('quantity_${item.id}', ${item.product.stock_product}, ${item.product.price_product}, this)">
                                +
                            </button>
                        </div>
                        <button onclick="deleteCart('${item.id}')" type="button" class="text-red-500 text-xs block text-end w-full">
                            Remove
                        </button>
                    </td>
                </tr>

            `
        })
        cartItems.innerHTML = items;
        document.getElementById('cartCount').textContent = data.length
        document.getElementById('cartCountItem').textContent = data.length
        setTotal()
    }
    */

    function listCart(data) {
        let items = '';
        let amount = 0; // Inisialisasi total amount
        const cartItems = document.getElementById('cartItems'); // Elemen untuk menampilkan item di keranjang

        data.forEach(item => {
            // Cek apakah produk memiliki gambar, jika tidak gunakan gambar default
            const imageSrc = item.product.image_product ?
                `{{ url('') }}/storage/${item.product.image_product}` :
                `{{ asset('img/img-carousel-promo/laptop.jpg') }}`; // Gambar default

            // Hitung total harga berdasarkan kuantitas produk
            amount += item.product.price_product * item.quantity;

            // Tambahkan item ke dalam tabel
            items +=
                `<tr class="border-b-2 border-slate-200">
                <th>
                    <div
                        class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center p-1 mb-2">
                        <img src="${imageSrc}" alt="Product Image"
                            width="80" height="80"
                            style="object-fit: cover; border-radius: 5px;"
                            loading="lazy"/>
                    </div>
                </th>
                <td class="w-full">
                    <a href="{{ url('') }}/product-show/${item.product.slug}" class="text-sm text-slate-700 mb-5">
                        ${item.product.name_product}
                    </a>
                    <p class="text-sm text-slate-500">${formatRupiah(item.product.price_product * item.quantity)}</p>
                </td>
                <td>
                    <p class="text-sm text-slate-500">x${item.quantity}</p>
                </td>
            </tr>`;
        });

        // Update isi keranjang
        cartItems.innerHTML = items;

        // Update jumlah item di keranjang
        document.getElementById('cartCount').textContent = data.length;
        document.getElementById('cartCountItem').textContent = data.length;

        // Update total
        setTotal(amount);
    }

    const totalAmount = document.getElementById('totalAmount');

    function setTotal() {
        if (!totalAmount) return false;
        totalAmount.textContent = formatRupiah(amount)
    }

    @if (auth()->user()->hasRole('user'))
        async function addToCart(id_product, el) {
            el.disabled = true;
            try {
                setTimeout(() => {
                    // Toast Notification
                    Swal.fire({
                        toast: true,
                        position: 'top-end', // Pojok kanan atas
                        icon: 'success',
                        title: 'Produk berhasil ditambahkan ke keranjang!',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
                    });
                }, 500);

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
                console.log(response)
                if (response.status == 'success') {
                    const data = await response.data;
                    listCart(data);
                    el.disabled = false;
                } else if (response.status == 'warning') {
                    alert(response.message)
                    el.disabled = false;
                } else {
                    showAlert('error', response.message)
                    el.disabled = false;
                }
            } catch (e) {
                console.log(e)
                el.disabled = false;
            }
        }

        async function deleteCart(id_cart) {
            Swal.fire({
                title: "Yakin?",
                text: "kamu yakin ingin menghapus keranjang ini?",
                icon: "warning",
                iconColor: "#334155",
                width: 400,
                background: "#fff",
                showCancelButton: true,
                confirmButtonColor: "#334155",
                cancelButtonColor: "#b91c1c",
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
                        width: 400,
                        confirmButtonColor: "#334155",
                        confirmButtonText: "tutup"
                    });
                }
            });

        }
    @endif
    window.addEventListener('DOMContentLoaded', async () => {
        try {
            const api = await fetch('/api/cart', {
                method: 'GET',
            });
            const response = await api.json();
            if (response.status == 'success') {
                const data = await response.data;
                listCart(data);
            } else {
                alert('keranjang gagal diload')
            }
        } catch (e) {
            console.log(e)
        }
    })




    async function minus(id, price, el) {
        el.disabled = true
        const input = document.getElementById(id);
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            totalAmount.innerHTML = `<p class="text-xm text-slate-800 font-medium tracking-tight">Loading...</p>`;

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

                amount = parseInt(amount) - parseInt(price);
                setTotal()
            } else {
                console.error('Server error or invalid response:', response.status);
                const text = await response.text();
                console.error('Response text:', text);
            }
            el.disabled = false;

        }
    }

    async function plus(id, max, price, el) {
        el.disabled = true;
        console.log(max);
        const input = document.getElementById(id);
        if (input.value < max) {
            input.value = parseInt(input.value) + 1;
            totalAmount.innerHTML = `<p class="text-xm text-slate-800 font-medium tracking-tight">Loading...</p>`;

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

                amount = parseInt(amount) + parseInt(price);
                setTotal()
            } else {
                console.error('Server error or invalid response:', response.status);
                const text = await response.text();
                console.error('Response text:', text);
            }
            el.disabled = false;
        } else {
            showAlert('error', 'stok product sudah habis')
            el.disabled = false;

        }
    }
    @endauth
</script>
