<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cart; // Pastikan ini sudah ada di model Keranjang
use App\Models\Order; // Pastikan ini sudah ada di model Order
use App\Models\Review; // Pastikan ini sudah ada di model Review

class ProfileController extends Controller
{
    /**
     * Display the user's profile form with additional data like total cart and orders.
     */
    public function profile(Request $request): View
    {
        // Ambil total keranjang dan total orders untuk pengguna
        $totalKeranjang = Cart::where('user_id', $request->user()->id)->count(); // Sesuaikan dengan logika Anda
        $totalOrders = Order::where('user_id', $request->user()->id)->count(); // Sesuaikan dengan logika Anda
        $totalReviews = Review::where('user_id', $request->user()->id)->count(); // Sesuaikan dengan logika Anda

        return view('user.profile.profile', [
            'user' => $request->user(),
            'totalKeranjang' => $totalKeranjang,
            'totalOrders' => $totalOrders,
            'totalReviews' => $totalReviews
        ]);
    }

    public function password(Request $request): View
    {
        return view('user.profile.password', [
            'user' => $request->user(),
        ]);
    }

    public function delete(Request $request): View
    {
        return view('user.profile.delete', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Cek apakah pengguna sudah memiliki gambar sebelumnya
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                // Hapus gambar lama dari storage
                Storage::disk('public')->delete($user->image);
            }

            // Simpan gambar baru ke storage (ke folder 'profile_images' dalam 'public' disk)
            $imagePath = $request->file('image')->store('profile_images', 'public');

            // Update kolom image di database dengan path gambar yang baru
            $user->image = $imagePath;
        }

        // Update data lainnya seperti name dan email
        $user->fill($request->validated());

        // Jika email berubah, set ulang email_verified_at
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan perubahan ke database
        $user->save();

        return Redirect::route('user.profile.profile')->with('success', 'Akun berhasil diperbarui');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
