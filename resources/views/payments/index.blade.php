@extends('home')

@section('content')
<div class="container">
    <h1>Daftar Pembayaran</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order </th>
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
                    <td>{{ $payment->order->product->name_product }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>
                        <img src="{{ Storage::url($payment->image_payment) }}" alt="Gambar Pembayaran" width="100">
                    </td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

