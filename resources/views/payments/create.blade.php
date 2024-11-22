@extends('home')

@section('content')
<div class="container">
    <h1>Tambah Pembayaran</h1>

    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Order</label>
            <select name="order_id" id="order_id" class="form-select" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->product->name_product }}</option>
                @endforeach
            </select>
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
           <label for="ststus" class="form-label">Status</label>
           <select name="status" id="status" class="form-control" required>
               <option value="pending">Pending</option>
               <option value="paid">Paid</option>
               <option value="canceled">Canceled</option>
           </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
