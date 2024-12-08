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
                        aria-controls="processing" aria-selected="false">Processing</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="pill" href="#completed" role="tab"
                        aria-controls="completed" aria-selected="false">Completed</a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-3" id="orderTabContent">

            <!-- Tab Pending -->
            <div class="tab-pane fade  show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'pending') as $order)
                        <div class="col-md-12 mb-4 ">
                            <div class="card ">
                                <div class="row g-0 py-3 px-5 align-items-center">

                                    <div class="d-flex justify-content-end align-items-center my-2">
                                        <p> {{ $order->created_at->translatedFormat('l, d F Y - H:i') }}
                                        </p>
                                    </div>
                                    <hr class="w-full">
                                    <!-- Gambar Produk (kiri) -->
                                    <div class="col-md-3">
                                        @if ($order->products && $order->products->isNotEmpty())
                                            <img src="{{ asset('storage/' . $order->products->first()->image_product) }}"
                                                class="img-fluid rounded-start"
                                                alt="{{ $order->products->first()->name_product }}">
                                        @else
                                            <p>No product found for this order.</p>
                                        @endif
                                    </div>
                                    <!-- Informasi Produk (kanan) -->
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $order->user->name }}</h5>

                                            @foreach ($order->productOrders as $productOrder)
                                                <div class="h4 font-bold">
                                                    {{ $productOrder->product->name_product }}
                                                </div>
                                                <div class="my-1">
                                                    Jumlah :
                                                    {{ $productOrder->quantity }}
                                                </div>
                                            @endforeach

                                            
                                            <p class="card-text my-1">
                                               @if ($order->addresses)
                                               ({{ $order->addresses->mark }}) - {{ $order->addresses->address }} <br>
                                                    <p class="h6 font-bold">{{ $order->addresses->no_telepon ?? 'Tidak ada' }}</p>
                                                @else
                                                    Alamat tidak tersedia
                                                @endif 
                                            </p>
                                            <p class="my-2 card-text"><span class="badge rounded-1 fw-semibold bg-primary">
                                                    {{ $order->status_order }}
                                                </span>

                                            </p>


                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <p class="h5 my-3 font-bold card-text">
                                                <span class="h5">Total Harga : </span>Rp . {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <hr class="w-full">

                                    <div class="d-flex justify-content-end my-2">
                                        <!-- Harga Total di Bawah -->

                                        <div class="d-flex">
                                            <!-- Tombol Edit dan Hapus -->
                                            <button type="button" class="btn btn-warning btn-sm me-2"
                                                data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Tab Processing -->
            <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'processing') as $order)
                        <div class="col-12 mb-4">
                            <div class="card w-100" style="height: auto;">
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

            <!-- Tab Completed -->
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <div class="row mt-3">
                    @foreach ($userOrders->where('status_order', 'completed') as $order)
                        <div class="col-12 mb-4">
                            <div class="card w-100" style="height: auto;">
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

        </div>
    </div>
@endsection
