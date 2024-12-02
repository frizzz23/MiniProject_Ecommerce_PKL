@extends('layouts.user')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Alamat Saya</h5>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#addAddressModal">
                        Tambah Alamat
                    </button>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">No</th>
                                    <th class="border-bottom-0">Pengguna</th>
                                    <th class="border-bottom-0">Sebagai</th>
                                    <th class="border-bottom-0">Alamat</th>
                                    <th class="border-bottom-0">No Telepon</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ $address->user->name }}</td>
                                        <td class="border-bottom-0">{{ $address->mark }}</td>
                                        <td class="border-bottom-0">{{ $address->address }}</td>
                                        <td class="border-bottom-0">{{ $address->no_telepon }}</td>
                                        <td class="border-bottom-0">
                                            <!-- Tombol untuk membuka modal Edit Alamat -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editAddressModal{{ $address->id }}">
                                                Edit
                                            </button>
                                            <!-- Form untuk menghapus alamat -->
                                            <form action="{{ route('user.addresses.destroy', $address->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1"
                                        aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">
                                                        Edit Alamat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.addresses.update', $address->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="mark">Tandai Sebagai</label>
                                                            <input type="text" name="mark" id="mark"
                                                                class="form-control"
                                                                placeholder="cth rumah/kantor/gedung/dll"
                                                                value="{{ $address->mark }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="address">Alamat</label>
                                                            <textarea name="address" id="address" class="form-control" rows="3" required>{{ $address->address }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="no_telepon">No Telepon</label>
                                                            <input type="text" name="no_telepon" id="no_telepon"
                                                                class="form-control" value="{{ $address->no_telepon }}"
                                                                required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Tambah Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.addresses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="mark">Tandai Sebagai</label>
                            <input type="text" name="mark" id="mark" class="form-control"
                                placeholder="cth rumah/kantor/gedung/dll" required>
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
@endsection
