@extends('home')

@section('content')
    <div class="container">
        {{-- <h1>Tambah Ulasan untuk Produk: {{ $product->name_product }}</h1> --}}

        <form action="{{ route('reviews.store', ['product' => $product->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id">Produk</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Pilih produk</option>
                    @foreach ($products as $$product)
                        <option value="{{ $$product->id }}">{{ $$product->name_product }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id">Pengguna</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Pilih pengguna</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="" disabled selected>Pilih Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Komentar</label>
                <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('reviews.index', $product->id) }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
@endsection
