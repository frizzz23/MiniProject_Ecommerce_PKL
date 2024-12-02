<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua alamat milik user yang sedang login
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('user.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Form untuk menambahkan alamat (user_id otomatis diambil dari Auth)
        return view('user.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        // Buat alamat baru untuk user yang sedang login
        Address::create([
            'user_id' => Auth::id(), // Hubungkan dengan user yang sedang login
            'mark' => $request->mark,
            'address' => $request->address,
            'no_telepon' => $request->no_telepon,
        ]);

        return redirect()->route('user.addresses.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        // Pastikan alamat yang diedit milik user yang sedang login
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan untuk mengedit alamat ini.');
        }

        return view('user.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        // Pastikan alamat yang diupdate milik user yang sedang login
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan untuk mengupdate alamat ini.');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        $address->update([
            'mark' => $request->mark,
            'address' => $request->address,
            'no_telepon' => $request->no_telepon,
        ]);

        return redirect()->route('user.addresses.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        // Pastikan alamat yang dihapus milik user yang sedang login
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan untuk menghapus alamat ini.');
        }

        $address->delete();

        return redirect()->route('user.addresses.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
