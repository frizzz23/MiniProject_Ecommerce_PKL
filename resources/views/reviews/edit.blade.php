@extends('home')

@section('content')
    <div class="container">
        {{-- <h1>Edit Ulasan untuk Produk: {{ $review->product->name_product }}</h1> --}}

        <form action="{{ route('reviews.update', ['review' => $review->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_id">Produk</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Pilih produk</option>
                    @foreach ($products as $product )
                        <option value="{{ $product ->id }}"
                            {{ $product ->id == $review->product_id ? 'selected' : '' }}>
                            {{ $product ->name_product }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id">Pengguna</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">Pilih pengguna</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $user->id == $review->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="" disabled>Pilih Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == $review->rating ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Komentar</label>
                <textarea name="comment" id="comment" class="form-control" rows="5">{{ old('comment', $review->comment) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('reviews.index', $review->product_id) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
