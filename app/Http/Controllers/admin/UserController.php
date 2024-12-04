<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $selectedRole = $request->input('role');

        // Query pengguna berdasarkan role yang dipilih
        $users = User::with('roles')->orderBy('created_at','desc')->when($selectedRole, function ($query, $selectedRole) {
                return $query->role($selectedRole); 
            })
            ->get();

        $roles = Role::all(); // Mendapatkan semua role untuk dropdown filter

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        // Mengambil data pengguna berdasarkan id
        $user = User::findOrFail($id);
        // Mendapatkan semua role yang tersedia
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the user's role.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,id', // Memastikan role yang dipilih ada di database
        ]);

        // Mencari pengguna berdasarkan id
        $user = User::findOrFail($id);

        // Mengupdate role pengguna
        $user->roles()->sync([$request->role]); // Menggunakan sync untuk mengganti semua role dengan yang baru

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage (optional).
     */
    public function destroy(string $id)
    {
        // Menghapus pengguna dari database
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
