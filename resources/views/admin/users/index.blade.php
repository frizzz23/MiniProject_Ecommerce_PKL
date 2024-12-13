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
            + Add new user
        </button>
        <div class="space-x-2">
            <form action="{{ route('admin.users.index') }}" method="GET" id="roleFilterForm" class="inline-block">
                <select name="role" id="role" class="form-select text-center" onchange="this.form.submit()">
                    <option value="">All Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <form action="{{ route('admin.users.index') }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_users" id="selected_users">
                <button type="button" class="bg-red-500 text-white py-1 px-3 rounded-md" id="delete-all-button">Delete all</button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-gray-100 rounded-lg border-2 border-[#5d85fa]">
        <table class="min-w-full table-auto">
            <thead class="bg-[#5d85fa] text-white">
                <tr>
                    <th class="py-3 px-4 text-left"><input type="checkbox" class="form-checkbox h-4 w-4 text-purple-600" id="select-all"></th>
                    <th class="py-3 px-4 text-left">USER</th>
                    <th class="py-3 px-4 text-left">USER ROLE</th>
                    <th class="py-3 px-4 text-left">STATUS</th>
                    <th class="py-3 px-4 text-left">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-b border-gray-700 hover:bg-slate-300">
                    <td class="py-3 px-4"> <input type="checkbox" class="form-checkbox h-4 w-4 text-purple-600 checkbox-user" value="{{ $user->id }}"> </td>
                    <td class="py-3 px-4 flex items-center"> <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-8 h-8 rounded-full mr-3"> <span>{{ $user->name }}</span> </td>
                    <td class="py-3 px-4">
                        @foreach ($user->roles as $role)
                            <span class="bg-[#5d85fa] text-white py-1 px-2 rounded-lg text-sm">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="py-3 px-4">
                        <span class="py-1 px-2 bg-green-600 text-white rounded-lg text-sm">Active</span>
                    </td>
                    <td class="py-3 px-4 space-x-2">
                        <button class="bg-red-600 text-white py-1 px-2 rounded-lg hover:bg-red-700" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $user->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong>{{ $user->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
                <h5 class="modal-title" id="tambahModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('.checkbox-user');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

function getSelectedUsers() {
    var selected = [];
    var checkboxes = document.querySelectorAll('.checkbox-user:checked');
    for (var checkbox of checkboxes) {
        selected.push(checkbox.value);
    }
    return selected;
}

document.getElementById('delete-all-button').onclick = function() {
    var selectedUsers = getSelectedUsers();
    if (selectedUsers.length > 0) {
        if (confirm('Are you sure you want to delete selected users?')) {
            document.getElementById('delete-form').submit();
        }
    } else {
        alert('Please select at least one user to delete.');
    }
}
</script>

@endsection
