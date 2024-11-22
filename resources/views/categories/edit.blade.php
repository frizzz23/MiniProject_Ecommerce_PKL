<!-- resources/views/categories/edit.blade.php -->
@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Edit Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_category" class="form-label">Nama Kategori</label>
            <input type="text" name="name_category" class="form-control" id="name_category" value="{{ old('name_category', $category->name_category) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

