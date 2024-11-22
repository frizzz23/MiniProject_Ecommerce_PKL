@extends('home')

@section('content')
    <div class="container">
        <h1>Ulasan untuk Produk: {{ $product->name }}</h1>
        <a href="{{ route('reviews.create', $product) }}" class="btn btn-primary mb-3">Tambah Ulasan</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->product->name_product }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>
                            <a href="{{ route('reviews.edit', $review) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
