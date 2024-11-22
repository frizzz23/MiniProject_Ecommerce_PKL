<!-- resources/views/categories/create.blade.php -->
@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name_category" class="form-label">Nama Kategori</label>
            <input type="text" name="name_category" class="form-control" id="name_category" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

