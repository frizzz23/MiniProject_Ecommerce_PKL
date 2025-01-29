<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedRole = $request->input('role');
        $search = $request->input('search');

        // Query pengguna berdasarkan role yang dipilih
        $users = User::with('roles')->orderBy('created_at', 'desc')->when($selectedRole, function ($query, $selectedRole) {
            return $query->role($selectedRole);
        })->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(15);
        // Iterasi untuk menambahkan 'joinDate' ke setiap pengguna
        $users->each(function ($user) {
            $user->joinDate = Carbon::parse($user->created_at)->diffForHumans();
        });

        // Mendapatkan semua role untuk dropdown filter
        $roles = Role::all();

        // Return view dengan data users dan roles
        return view('admin.users.index', compact('users', 'roles'));
    }


    /**
     * Show the form for editing the specified user.
     */


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tetapkan role admin secara otomatis
        $user->assignRole('admin');

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan dengan role Admin.');
    }


    public function edit(string $id) {}

    /**
     * Update the user's role.
     */
    public function update(Request $request, string $id) {}

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

    public function deleteMultiple(Request $request)
    {
        $userIds = $request->input('selected_users');
        if (!empty($userIds)) {
            User::whereIn('id', $userIds)->delete();
            return redirect()->route('admin.users.index')->with('success', 'Selected users have been deleted.');
        }

        return redirect()->route('admin.users.index')->with('error', 'No users selected for deletion.');
    }
}
