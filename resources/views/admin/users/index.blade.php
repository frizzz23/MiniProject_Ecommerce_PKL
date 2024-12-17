@extends('layouts.admin')

@section('main')
<div class="p-6">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Table Actions -->
    <div class="flex justify-between items-center mb-4">
        <button class="btn btn-primary text-white py-2 px-4 rounded-lg" data-bs-toggle="modal" data-bs-target="#tambahModal">
            + Tambahkan pengguna baru
        </button>
        <div class="space-x-2">
            <form action="{{ route('admin.users.index') }}" method="GET" id="roleFilterForm" class="inline-block">
                <select name="role" id="role" class="form-select text-center" onchange="this.form.submit()">
                    <option value="">Semua Peran</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-gray-100 rounded-lg border-2 border-[#5d85fa]">
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
                        <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-8 h-8 rounded-full mr-3"> 
                        <span>{{ $user->name }}</span> 
                    </td>
                    <td class="py-3 px-4">
                        @foreach ($user->roles as $role)
                            <span class="bg-[#5d85fa] text-white py-1 px-2 rounded-lg text-sm">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="py-3 px-4">
                        {{  $user->joinDate }}
                    </td>
                    <td class="py-3 px-4 space-x-2">
                        <button class="bg-red-600 text-white py-1 px-2 rounded-lg hover:bg-red-700" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $user->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block">
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
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
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
