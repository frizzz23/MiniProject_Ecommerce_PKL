<!-- resources/views/carts/create.blade.php -->
@extends('layouts.app')

@section('main')
    <div class="container">
        <h1>Tambah Produk ke Keranjang</h1>

        <form action="{{ route('carts.store') }}" method="POST">
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
                <div class="flex gap-3 col-md-3 justify-content-between align-items-center">
                    <button type="button" onclick="kurang()" class="btn btn-sm btn-danger">-</button>
                    <input type="number" class="form-control" name="quantity" id="jumlah"required value="0">
                    <button type="button" onclick="tambah()" class="btn btn-sm btn-success">+</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambahkan</button>
            <a href="{{ route('carts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        function kurang() {
            const jumlah = document.getElementById("jumlah");
            if (jumlah.value > 0) {
                jumlah.value = parseInt(jumlah.value) - 1;
            }
        }

        function tambah() {
            const jumlah = document.getElementById("jumlah");
            if (jumlah.value < 15) {
                jumlah.value = parseInt(jumlah.value) + 1;
            }
        }
    </script>
@endsection
