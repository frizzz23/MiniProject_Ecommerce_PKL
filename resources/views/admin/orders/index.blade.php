<!-- resources/views/orders/index.blade.php -->
@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="card w-full">
                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Semua Order</h5>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.orders.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <!-- Filter Kategori -->
                                <form id="filterForm" method="{{ route('admin.orders.index') }}" method="GET">
                                    <div class="d-flex align-items-center ">
                                        <select name="product_id"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            style="width: 200px;"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">Semua Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name_product }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                        <form action="{{ route('admin.orders.index') }}" method="GET">
                            <div class="grid grid-cols-3 gap-3 text-white border-t border-gray-600 pt-4 mb-4">
                                <div>
                                    <select name="price"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Harga</option>
                                        <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>
                                            Terendah ke Tertinggi
                                        </option>
                                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>
                                            Tertinggi ke Terendah
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <select name="status_order"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Status</option>
                                        <option value="pending" {{ request('status_order') == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="processing" {{ request('status_order') == 'processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>
                                        <option value="completed" {{ request('status_order') == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <select name="created_at"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        onchange="this.form.submit()">
                                        <option value="">Tanggal</option>
                                        <option value="asc" {{ request('created_at') == 'asc' ? 'selected' : '' }}>Lama</option>
                                        <option value="desc" {{ request('created_at') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th style="width: 5%;" class="px-4 py-2 text-left">No</th>
                                    <th style="width: 10%;" class="px-4 py-2 text-left">Pelanggan</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left">Produk</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left">Total</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left">Status</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left">Dibuat</th>
                                    <th style="width: 10%;" class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-100  border-b">
                                        <td class="px-4 py-2">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="px-4 py-2">
                                            @if ($order->productOrders->count() > 2)
                                                <ul class="list-disc">
                                                    @foreach ($order->productOrders->take(2) as $productOrder)
                                                        <li class="flex justify-between items-center">
                                                            <span>{{ $productOrder->product->name_product }}</span>
                                                            <span class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                        </li>
                                                    @endforeach
                                                    <span class="flex justify-center text-2xl font-bold">...</span>
                                                </ul>
                                            @else
                                                <ul class="list-disc">
                                                    @foreach ($order->productOrders as $productOrder)
                                                        <li class="flex justify-between items-center">
                                                            <span>{{ $productOrder->product->name_product }}</span>
                                                            <span class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            Rp.
                                            {{ number_format($order->grand_total_amount, 0, '.', '.') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <span 
                                                    class="px-3 py-1 rounded-full text-sm font-semibold 
                                                        @if ($order->status_order === 'completed') 
                                                            bg-green-200 text-green-600 
                                                        @elseif ($order->status_order === 'processing') 
                                                            bg-yellow-200 text-yellow-600 
                                                        @elseif ($order->status_order === 'pending') 
                                                            bg-blue-200 text-blue-600 
                                                        @else 
                                                            bg-gray-200 text-gray-600 
                                                        @endif">
                                                    {{ ucfirst($order->status_order) }}
                                                </span>
                                            </div>
                                            
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $order->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-2">
                                                <div class="relative group inline-block">
                                                    <a href="{{ route('admin.orders.show', $order->id ) }}"
                                                        class="bg-blue-500 text-white px-3 py-1 rounded flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 24 24" fill="currentColor">
                                                            <path
                                                                d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-3.866 0-7-4.134-7-5s3.134-5 7-5 7 4.134 7 5-3.134 5-7 5zm0-8c-1.103 0-2 2.015-2 3s.897 3 2 3 2-2.015 2-3-.897-3-2-3z" />
                                                        </svg>
                                                    </a>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45 "></span>
                                                        Detail
                                                    </span>
                                                </div>
                                                <!-- Tombol Edit -->
                                                <div class="relative group inline-block">
                                                    <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded flex items-center" data-bs-toggle="modal"
                                                        data-bs-target="#editOrderModal{{ $order->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L8 9.172 7 13l3.828-1L17.414 5.414a2 2 0 000-2.828l-1-1zM15 4l1-1L15 2l-1 1 1 1zM4 13v3h3l9-9-3-3L4 13z" />
                                                        </svg>
                                                    </button>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                        Edit
                                                    </span>
                                                </div>

                                                <!-- Form Hapus Pesanan -->
                                                <div class="relative group inline-block">
                                                    <!-- Tombol Hapus yang akan membuka modal konfirmasi -->
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded flex items-center"
                                                            data-bs-toggle="modal" data-bs-target="#hapusmodal{{ $order->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6 4a1 1 0 000 2h8a1 1 0 100-2H6zM3 6a1 1 0 011-1h12a1 1 0 011 1v11a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 9a1 1 0 102 0V8a1 1 0 00-2 0v7zm5-1a1 1 0 10-2 0V8a1 1 0 112 0v6z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                        <span class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                            <span class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                            Hapus
                                                        </span>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $order->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel{{ $order->id }}">Hapus Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="color: black;">
                                                    Apakah Anda yakin ingin menghapus pesanan <strong>{{ $order->order }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                    <!-- Form untuk menghapus voucher -->
                                                    <form action="{{ route('admin.discount.destroy', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal detail -->
                                    <div class="modal fade" id="detailOrderModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="detailOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="detailOrderModalLabel{{ $order->id }}">
                                                        Detail Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form inside modal -->

                                                    <!-- Form fields for editing -->
                                                    <div class="mb-3">
                                                        <div
                                                            class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                            <span>pelanggan</span>
                                                            <span>:</span>
                                                            <span>{{ $order->user->name }}</span>
                                                        </div>
                                                        <div
                                                            class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                            <span>Produk</span>
                                                            <span>:</span>
                                                            <ul class="list-disc">
                                                                @foreach ($order->productOrders as $productOrder)
                                                                    <li class="flex justify-between items-center">
                                                                        <span>{{ $productOrder->product->name_product }}</span>
                                                                        <span
                                                                            class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="border-2 p-2 border-slate-300 mb-2">
                                                            <span class="text-sm ">Pembayaran</span>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>metode pembayaran</span>
                                                                <span>:</span>
                                                                <span>{{ $order->payment->payment_method }}</span>
                                                                </span>
                                                            </div>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>status pembayaran</span>
                                                                <span>:</span>
                                                                <span>{{ $order->payment->status }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="border-2 p-2 border-slate-300 mb-2">
                                                            <span class="text-sm ">Total</span>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>sub total</span>
                                                                <span>:</span>
                                                                <span>
                                                                    <span class="w-5 h-5"></span>
                                                                    Rp.
                                                                    {{ number_format($order->sub_total_amount, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>ongkos kirim</span>
                                                                <span>:</span>
                                                                <span>+ Rp.
                                                                    {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</span>
                                                            </div>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>diskon</span>
                                                                <span>:</span>
                                                                <span>- Rp.
                                                                    {{ $order->promoCode?->discount_amount ? number_format($order->promoCode->discount_amount, 0, ',', '.') : '' }}</span>
                                                            </div>
                                                            <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                                <span>total</span>
                                                                <span>:</span>
                                                                <span>Rp.
                                                                    {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Alamat</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>alamat</span>
                                                            <span>:</span>
                                                            <span>{{ $order->addresses->address }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>no telp</span>
                                                            <span>:</span>
                                                            <span>{{ $order->addresses->no_telepon }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-2 text-right">
                                                        <span
                                                            class="text-xs">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">
                                                        Edit Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <!-- Form inside modal -->
                                                    <form action="{{ route('admin.orders.update', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Form fields for editing -->
                                                        <div class="mb-3">
                                                            <label for="edit_status_order" class="form-label">Status
                                                                Order</label>
                                                            <select name="status_order" class="form-select" required>
                                                                <option value="pending"
                                                                    {{ $order->status_order == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="processing"
                                                                    {{ $order->status_order == 'processing' ? 'selected' : '' }}>
                                                                    Processing</option>
                                                                <option value="completed"
                                                                    {{ $order->status_order == 'completed' ? 'selected' : '' }}>
                                                                    Completed</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
     <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection

{{-- <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    No
                                </th>
                                <th class="border-bottom-0">
                                    User
                                </th>
                                <th class="border-bottom-0">
                                    Produk
                                </th>
                                <th class="border-bottom-0">
                                    Total
                                </th>
                                <th class="border-bottom-0">
                                    Status
                                </th>
                                <th class="border-bottom-0">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="border-bottom-0">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $order->user->name }}
                                    </td>
                                    <td class="border-bottom-0">
                                        <ul class="list-disc">
                                            @foreach ($order->productOrders as $productOrder)
                                                <li class="flex justify-between items-center">
                                                    <span>{{ $productOrder->product->name_product }}</span>
                                                    <span
                                                        class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="border-bottom-0">
                                        Rp.
                                        {{ number_format($order->grand_total_amount, 2) }}
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span
                                                class="badge bg-secondary rounded-1 fw-semibold">{{ ucfirst($order->status_order) }}</span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="flex gap-2">
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailOrderModal{{ $order->id }}">
                                                Detail
                                            </button>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editOrderModal{{ $order->id }}">
                                                Edit
                                            </button>

                                            <!-- Form Hapus Pesanan -->
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="detailOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="detailOrderModalLabel{{ $order->id }}">
                                                    Detail Pesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form inside modal -->

                                                <!-- Form fields for editing -->
                                                <div class="mb-3">
                                                    <div
                                                        class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                        <span>pelanggan</span>
                                                        <span>:</span>
                                                        <span>{{ $order->user->name }}</span>
                                                    </div>
                                                    <div
                                                        class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                        <span>Produk</span>
                                                        <span>:</span>
                                                        <ul class="list-disc">
                                                            @foreach ($order->productOrders as $productOrder)
                                                                <li class="flex justify-between items-center">
                                                                    <span>{{ $productOrder->product->name_product }}</span>
                                                                    <span
                                                                        class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Pembayaran</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>metode pembayaran</span>
                                                            <span>:</span>
                                                            <span>{{ $order->payment->payment_method }}</span>
                                                            </span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>status pembayaran</span>
                                                            <span>:</span>
                                                            <span>{{ $order->payment->status }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Total</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>sub total</span>
                                                            <span>:</span>
                                                            <span>Rp.
                                                                {{ number_format($order->sub_total_amount, 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>ongkos kirim</span>
                                                            <span>:</span>
                                                            <span>+ Rp.
                                                                {{ $order->postage->ongkir_total_amount }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>diskon</span>
                                                            <span>:</span>
                                                            <span>- Rp.
                                                                {{ $order->promoCode->discount_amount ?? '' }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>total</span>
                                                            <span>:</span>
                                                            <span>Rp.
                                                                {{ number_format($order->grand_total_amount, 2) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-2 p-2 border-slate-300 mb-2">
                                                    <span class="text-sm ">Alamat</span>
                                                    <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                        <span>alamat</span>
                                                        <span>:</span>
                                                        <span>{{ $order->addresses->address }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                        <span>no telp</span>
                                                        <span>:</span>
                                                        <span>{{ $order->addresses->no_telepon }}</span>
                                                    </div>
                                                </div>

                                                <div class="mb-2 text-right">
                                                    <span
                                                        class="text-xs">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">
                                                    Edit Pesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Form inside modal -->
                                                <form action="{{ route('admin.orders.update', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Form fields for editing -->
                                                    <div class="mb-3">
                                                        <label for="edit_status_order" class="form-label">Status
                                                            Order</label>
                                                        <select name="status_order" class="form-select" required>
                                                            <option value="pending"
                                                                {{ $order->status_order == 'pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="processing"
                                                                {{ $order->status_order == 'processing' ? 'selected' : '' }}>
                                                                Processing</option>
                                                            <option value="completed"
                                                                {{ $order->status_order == 'completed' ? 'selected' : '' }}>
                                                                Completed</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table> --}}
