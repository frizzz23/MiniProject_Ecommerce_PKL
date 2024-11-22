@extends('home')

@section('content')
<div class="container">
    <h1>Daftar Alamat</h1>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Tambah Alamat</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($addresses as $address)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $address->user->name }}</td>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->no_telepon }}</td>
                    <td>
                        <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
