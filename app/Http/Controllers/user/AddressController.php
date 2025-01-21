<?php

namespace App\Http\Controllers\user;

use App\Models\City;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data alamat milik user yang sedang login
        $addresses = Address::where('user_id', Auth::id())->get();
        // dd($addresses);
        // Ambil data provinsi dengan filter jika ada
        $cities = City::relatedData();




        return view('user.addresses.index', compact('addresses', 'cities',));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data provinsi dari RajaOngkirController
        $provinces = $this->getProvinces(); // Ambil provinsi

        return view('user.addresses.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mark' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'city_id' => 'required|integer', // Validasi city_id
        ], [
            'mark.required' => 'Nama alamat wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'city_id.required' => 'Kota wajib diisi.',
        ]);

        // Buat alamat baru untuk user yang sedang login
        Address::create([
            'user_id' => Auth::id(),
            'mark' => $request->mark,
            'address' => $request->address,
            'no_telepon' => $request->no_telepon,
            'city_id' => $request->city_id,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan.');
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

        // Ambil data provinsi dari RajaOngkirController
        $provinces = $this->getProvinces();
        $cities = $this->getCities($address->city_id); // Ambil kota berdasarkan city_id yang sudah ada

        return view('user.addresses.edit', compact('address', 'provinces', 'cities'));
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
            'mark' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'city_id' => 'required|integer', // Validasi city_id
        ], [
            'mark.required' => 'Nama alamat wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'city_id.required' => 'Kota wajib diisi.',
        ]);;

        $address->update([
            'mark' => $request->mark,
            'address' => $request->address,
            'no_telepon' => $request->no_telepon,
            'city_id' => $request->city_id,
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

    /**
     * Mendapatkan daftar provinsi dari RajaOngkirController
     */
    private function getProvinces()
    {
        $response = Http::get(route('api.raja-ongkir.province'));
        return $response->json();
    }

    /**
     * Mendapatkan daftar kota berdasarkan provinsi
     */
    private function getCities($city_id = null)
    {
        $response = Http::get(route('api.raja-ongkir.city', ['province_id' => $city_id]));
        return $response->json();
    }
}
