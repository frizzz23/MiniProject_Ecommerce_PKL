@extends('home')

@section('content')
<div class="container">
    <h1>Tambah Alamat</h1>

    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id">Pengguna</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
