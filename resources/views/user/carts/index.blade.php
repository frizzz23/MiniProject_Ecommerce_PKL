@extends('layouts.user')

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
                    <h5 class="card-title fw-semibold mb-4">Keranjang Saya</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">No</th>
                                    <th class="border-bottom-0">Nama Produk</th>
                                    <th class="border-bottom-0">Jumlah</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ $cart->product->name_product }}</td>
                                        <td class="border-bottom-0">{{ $cart->quantity }}</td>
                                        <td class="border-bottom-0">
                                            <!-- Tombol Edit Produk -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $cart->id }}">
                                                Edit
                                            </button>
                                            <!-- Form Hapus Produk -->
                                            <form action="{{ route('user.carts.destroy', $cart->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $cart->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $cart->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $cart->id }}">Edit
                                                        Produk di Keranjang
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.carts.update', $cart->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Tampilkan nama produk sebagai teks -->
                                                        <div class="mb-3">
                                                            <label for="product_name_{{ $cart->id }}"
                                                                class="form-label">Produk</label>
                                                            <input type="text" class="form-control"
                                                                id="product_name_{{ $cart->id }}"
                                                                value="{{ $cart->product->name_product }}" disabled>
                                                        </div>

                                                        <!-- Input untuk jumlah -->
                                                        <div class="mb-3">
                                                            <label for="jumlah_{{ $cart->id }}"
                                                                class="form-label">Jumlah</label>
                                                            <div class="d-flex gap-3">
                                                                <button type="button"
                                                                    onclick="kurang('jumlah_{{ $cart->id }}')"
                                                                    class="btn btn-sm btn-danger">-</button>
                                                                <input type="number" class="form-control" name="quantity"
                                                                    id="jumlah_{{ $cart->id }}" required
                                                                    value="{{ $cart->quantity }}" min="1">
                                                                <button type="button"
                                                                    onclick="tambah('jumlah_{{ $cart->id }}')"
                                                                    class="btn btn-sm btn-success">+</button>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Keranjang kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol untuk memunculkan modal tambah keranjang -->
    {{-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#cartModal">
            Tambah Keranjang
        </button> --}}
    <!-- Modal Tambah Keranjang -->
    {{-- <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Tambah Produk ke Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.carts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Nama Produk</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <div class="d-flex gap-3">
                            <button type="button" onclick="kurang('jumlah')" class="btn btn-sm btn-danger">-</button>
                            <input type="number" class="form-control" name="quantity" id="jumlah" required value="1">
                            <button type="button" onclick="tambah('jumlah')" class="btn btn-sm btn-success">+</button>
                        </div>
                    </div>


                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div> --}}

    <script>
        function kurang(target) {
            const jumlah = document.getElementById(target);
            if (jumlah.value > 1) {
                jumlah.value = parseInt(jumlah.value) - 1;
            }
        }

        function tambah(target) {
            const jumlah = document.getElementById(target);
            jumlah.value = parseInt(jumlah.value) + 1;
        }
    </script>
@endsection
