<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::with('user')->get(); // Mengambil data dengan relasi user
        $users = User::all(); // Ambil semua data pengguna untuk dropdown
        return view('addresses.index', compact('addresses', 'users'));
    }

    public function create()
    {
        $users = User::all(); // Ambil semua data pengguna untuk dropdown
        return view('addresses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        Address::create($request->all());

        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function edit(Address $address)
    {
        $users = User::all(); // Ambil semua pengguna untuk dropdown
        return view('addresses.edit', compact('address', 'users'));
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
