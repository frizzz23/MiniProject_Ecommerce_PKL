@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="card w-full">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar User</h5>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.products.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <button class="btn btn-primary text-white py-2 px-4 rounded-lg" data-bs-toggle="modal"
                                    data-bs-target="#tambahModal">
                                    + Tambahkan pengguna baru
                                </button>
                                <!-- Filter Kategori -->
                                <form id="filterForm" action="{{ route('admin.reviews.index') }}" method="GET">
                                    <div class="d-flex align-items-center ">
                                        <select name="role" id="role"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            style="width: 200px;"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">Semua Peran</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ request('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 gap-4 text-white border-t border-gray-600 pt-4 ">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th class="px-4 py-2 text-left">Gambar</th>
                                    <th class="px-4 py-2 text-left">Pengguna</th>
                                    <th class="px-4 py-2 text-left">Peran</th>
                                    <th class="px-4 py-2 text-left">Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr onclick="toggleDropdown(this)" class="hover:bg-gray-50 cursor-pointer border-b">
                                        <td class="px-4 py-2">
                                            <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                class="w-8 h-8 rounded-full mr-3">
                                        </td>
                                        <td class="px-4 py-2 flex items-center">
                                            <span>{{ $user->name }}</span>
                                        </td>
                                        <td class="px-4 py-2">
                                            @foreach ($user->roles as $role)
                                                <span
                                                    class="bg-[#5d85fa] text-white py-1 px-2 rounded-md text-sm">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $user->joinDate }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



<!-- Table lama -->
{{-- <div class="overflow-x-auto bg-gray-100 rounded-lg border-2 border-[#5d85fa]">
    <table class="min-w-full table-auto">
        <thead class="bg-[#5d85fa] text-white">
            <tr>
                <th class="py-3 px-4 text-left">PENGGUNA</th>
                <th class="py-3 px-4 text-left">PERAN PENGGUNA</th>
                <th class="py-3 px-4 text-left">BERGABUNG</th>
                <th class="py-3 px-4 text-left">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b border-gray-700 hover:bg-slate-300">
                    <td class="py-3 px-4 flex items-center">
                        <img src="https://via.placeholder.com/40" alt="User Avatar"
                            class="w-8 h-8 rounded-full mr-3">
                        <span>{{ $user->name }}</span>
                    </td>
                    <td class="py-3 px-4">
                        @foreach ($user->roles as $role)
                            <span
                                class="bg-[#5d85fa] text-white py-1 px-2 rounded-lg text-sm">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="py-3 px-4">
                        {{ $user->joinDate }}
                    </td>
                    <td class="py-3 px-4 space-x-2">
                        <button class="bg-red-600 text-white py-1 px-2 rounded-lg hover:bg-red-700"
                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $user->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                    method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div> --}}
