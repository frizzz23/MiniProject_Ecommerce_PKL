@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Daftar Alamat</h1>

    <!-- Tombol untuk membuka modal Tambah Alamat -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">
        Tambah Alamat
    </button>

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
                        <!-- Tombol untuk membuka modal Edit Alamat -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">
                            Edit
                        </button>
                        <!-- Form untuk menghapus alamat -->
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


    <!-- Modal untuk menambah alamat -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Tambah Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk mengedit alamat -->
    @foreach ($addresses as $address)
        <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">Edit Alamat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="user_id">Pengguna</label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="">Pilih Pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $address->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" class="form-control" rows="3" required>{{ $address->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon">No Telepon</label>
                                <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ $address->no_telepon }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
