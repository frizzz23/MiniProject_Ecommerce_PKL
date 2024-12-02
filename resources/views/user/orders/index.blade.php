@extends('layouts.user')

@section('main')
    <div class="container-fluid">
        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Card with Tabs -->
        <div class="card p-2">
            <ul class="nav nav-pills gap-4 w-100" id="orderTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pending-tab" data-bs-toggle="pill" href="#pending" role="tab"
                        aria-controls="pending" aria-selected="true">Pending</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="processing-tab" data-bs-toggle="pill" href="#processing" role="tab"
                        aria-controls="processing" aria-selected="false">processing</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="pill" href="#completed" role="tab"
                        aria-controls="completed" aria-selected="false">completed</a>
                </li>
                <!-- Tab tambahan bisa ditambahkan sesuai kebutuhan -->
            </ul>
        </div>
        <div class="tab-content mt-3" id="orderTabContent">

            <!-- Tab Pending -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'pending') as $order)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order->user->name }}</h5>
                                    <p class="card-text">Produk:
                                        @foreach ($order->productOrders as $productOrder)
                                            <span>{{ $productOrder->product->name_product }}</span><br>
                                        @endforeach
                                    </p>
                                    <p class="card-text">Subtotal: Rp.
                                        {{ number_format($order->sub_total_amount, 2) }}</p>
                                    <p class="card-text">Total: Rp.
                                        {{ number_format($order->grand_total_amount, 2) }}</p>
                                    <p class="card-text">Status: {{ ucfirst($order->status_order) }}</p>

                                    <div class="d-flex justify-content-between">
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editOrderModal{{ $order->id }}">
                                            Edit
                                        </button>

                                        <!-- Form Hapus Pesanan -->
                                        <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab processing -->
            <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'processing') as $order)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order->user->name }}</h5>
                                    <p class="card-text">Produk:
                                        @foreach ($order->productOrders as $productOrder)
                                            <span>{{ $productOrder->product->name_product }}</span><br>
                                        @endforeach
                                    </p>
                                    <p class="card-text">Subtotal: Rp.
                                        {{ number_format($order->sub_total_amount, 2) }}</p>
                                    <p class="card-text">Total: Rp.
                                        {{ number_format($order->grand_total_amount, 2) }}</p>
                                    <p class="card-text">Status: {{ ucfirst($order->status_order) }}</p>

                                    <div class="d-flex justify-content-between">
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editOrderModal{{ $order->id }}">
                                            Edit
                                        </button>

                                        <!-- Form Hapus Pesanan -->
                                        <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            {{-- tab comleted --}}

            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'completed') as $order)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order->user->name }}</h5>
                                    <p class="card-text">Produk:
                                        @foreach ($order->productOrders as $productOrder)
                                            <span>{{ $productOrder->product->name_product }}</span><br>
                                        @endforeach
                                    </p>
                                    <p class="card-text">Subtotal: Rp.
                                        {{ number_format($order->sub_total_amount, 2) }}</p>
                                    <p class="card-text">Total: Rp.
                                        {{ number_format($order->grand_total_amount, 2) }}</p>
                                    <p class="card-text">Status: {{ ucfirst($order->status_order) }}</p>

                                    <div class="d-flex justify-content-between">
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editOrderModal{{ $order->id }}">
                                            Edit
                                        </button>

                                        <!-- Form Hapus Pesanan -->
                                        <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab lainnya bisa ditambahkan di sini -->
        </div>
    </div>

    <!-- Modal Bootstrap untuk Tambah Pesanan -->
    {{-- Modal code remains unchanged --}}
@endsection
