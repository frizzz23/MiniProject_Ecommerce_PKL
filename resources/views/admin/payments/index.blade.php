@extends('layouts.admin')

@section('main')
<div class="container">
    <h1>Daftar Pembayaran</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button untuk membuka modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
        Tambah Pembayaran
    </button>

    <!-- Tabel Daftar Pembayaran -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>
                        @foreach ($payment->order->product as $product)
                            {{ $product->name_product }}@if(!$loop->last), @endif
                        @endforeach
                    </td>

                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>
                        <img src="{{ Storage::url($payment->image_payment) }}" alt="Gambar Pembayaran" width="100">
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->id }}">
                            Edit
                        </button>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Pembayaran -->
                <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPaymentModalLabel{{ $payment->id }}">Edit Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- <div class="mb-3">
                                        <label for="order_id" class="form-label">Order</label>
                                        <select name="order_id" id="order_id" class="form-select" required>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}">
                                                    @foreach ($order->product as $product)
                                                        {{ $product->name_product }}
                                                    @endforeach
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}


                                    <div class="mb-3">
                                        <label for="image_payment" class="form-label">Gambar Pembayaran</label>
                                        <input type="file" name="image_payment" id="image_payment" class="form-control">
                                        <small>Biarkan kosong jika tidak mengubah gambar</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                        <select name="payment_method" id="payment_method" class="form-control" required>
                                            <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="transfer" {{ $payment->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                       <label for="status" class="form-label">Status</label>
                                       <select name="status" id="status" class="form-control" required>
                                           <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                           <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                           <option value="canceled" {{ $payment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                       </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Pembayaran -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">Tambah Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order</label>
                            <select name="order_id" id="order_id" class="form-select" required>
                                <option value="">Pilih Order</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">
                                        {{ implode(', ', $order->product->pluck('name_product')->toArray()) }}
                                    </option>
                                @endforeach
                        </div>


                        <div class="mb-3">
                            <label for="image_payment" class="form-label">Gambar Pembayaran</label>
                            <input type="file" name="image_payment" id="image_payment" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                           <label for="status" class="form-label">Status</label>
                           <select name="status" id="status" class="form-control" required>
                               <option value="pending">Pending</option>
                               <option value="paid">Paid</option>
                               <option value="canceled">Canceled</option>
                           </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
