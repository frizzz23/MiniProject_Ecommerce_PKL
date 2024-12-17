<!-- resources/views/orders/index.blade.php -->
@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Semua Order</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
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
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="detailOrderModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="detailOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailOrderModalLabel{{ $order->id }}">
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
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
