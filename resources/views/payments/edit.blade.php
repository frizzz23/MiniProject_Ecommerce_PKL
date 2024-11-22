@extends('home')

@section('content')
<div class="container">
    <h1>Edit Pembayaran</h1>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="order_id" class="form-label">Order</label>
            <input type="text" name="order_id" id="order_id" class="form-control" value="{{ $payment->order->product->name_product }}" required>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
           <select name="payment_method" id="payment_method" class="form-control" required>
               <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
               <option value="transfer" {{ $payment->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
           </select>
        </div>

        <div class="mb-3">
            <label for="image_payment" class="form-label">Gambar Pembayaran</label>
            <input type="file" name="image_payment" id="image_payment" class="form-control">
            <small>Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="canceled" {{ $payment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
