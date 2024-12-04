<!-- resources/views/users/index.blade.php -->

@extends('layouts.admin')

@section('main')
    <style>
        /* Ketika checkbox aktif, ubah tampilan label */
        .form-check-input:checked+.form-check-label {
            background-color: #007bff;
            /* Warna biru seperti Shopee */
            color: white;
            border-color: #007bff;
        }

        /* Tambahan efek hover */
        .form-check-label:hover {
            background-color: #e9ecef;
        }
    </style>
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <div class="container flex justify-between">
                        <h5 class="card-title fw-semibold mb-4">Semua User</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <div class="dropdown-menu my-2 p-3 w-[200px] " aria-labelledby="dropdownMenuButton1">
                                <form action="{{ route('admin.users.index') }}" method="GET">
                                    <label for="role" class="my-1"> Role</label>
                                    <select name="role" id="role" class="form-select my-1 text-center ">
                                        <option value="">All Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ request('role') == $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary my-1 ">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap text-center mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">No</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Roles</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ $user->name }}</td>
                                        <td class="border-bottom-0">{{ $user->email }}</td>
                                        <td class="border-bottom-0">
                                            @foreach ($user->roles as $role)
                                                <div class="d-flex align-items-center justify-center gap-2">
                                                    <span
                                                        class="badge rounded-1 fw-semibold 
                                                        {{ $role->name == 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                                        {{ $role->name }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="border-bottom-0">
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editmodal{{ $user->id }}">
                                                Edit
                                            </button>


                                            <!-- Delete Form -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <!-- Modal Edit -->
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">
                                                        Edit Pengguna</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form inside modal -->
                                                    <form action="{{ route('admin.users.update', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT') <!-- Untuk method PUT -->

                                                        <!-- Display Name as Read-Only -->
                                                        <div class="mb-3">
                                                            <label for="edit_name" class="form-label">Nama</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $user->name }}" readonly>
                                                        </div>

                                                        <!-- Display Email as Read-Only -->
                                                        <div class="mb-3">
                                                            <label for="edit_email" class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $user->email }}" readonly>
                                                        </div>

                                                        <!-- Role Selection Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="edit_role" class="form-label">Role</label>
                                                            <select name="role" class="form-select" required>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
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

    {{-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahmodal">
        Tambah Pengguna
    </button>
    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
