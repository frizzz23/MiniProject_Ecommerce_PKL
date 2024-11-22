@extends('home')

@section('content')
<div class="container">
    <h1>Edit Alamat</h1>

    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id">Pengguna</label>
            <select name="user_id" id="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $address->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', $address->address) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ old('no_telepon', $address->no_telepon) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
