<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        // Mengambil semua pembayaran
        $payments = Payment::with('order')->get();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create(Order $order)
    {
        $orders = Order::all();
        return view('payments.create', compact('orders'));
    }

    /**
     * Store a newly created payment in the database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'image_payment' => 'required|image',
            'payment_method' => 'required|in:cash, transfer',
            'status' => 'required|in:pending, paid, canceled',
        ]);

        // Menyimpan pembayaran
        $payment = new Payment();
        $payment->order_id = $request->order_id;

        // Menyimpan gambar pembayaran
        if ($request->hasFile('image_payment')) {
            $payment->image_payment = $request->file('image_payment')->store('payments', 'public');
        }

        $payment->payment_method = $request->payment_method;
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {
        $orders = Order::all();
        return view('payments.edit', compact('payment', 'orders'));
    }

    /**
     * Update the specified payment in the database.
     */
    public function update(Request $request, Payment $payment)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'image_payment' => 'required|image',
            'payment_method' => 'required|in:cash, transfer',
            'status' => 'required|in:pending, paid, canceled',
        ]);

        // Update pembayaran
        $payment->payment_method = $request->payment_method;

        if ($request->hasFile('image_payment')) {
            // Hapus gambar lama jika ada
            if ($payment->image_payment) {
                Storage::delete($payment->image_payment);
            }

            // Simpan gambar baru
            $payment->image_payment = $request->file('image_payment')->store('payments', 'public');
        }

        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified payment from the database.
     */
    public function destroy(Payment $payment)
    {
        // Hapus pembayaran
        if ($payment->image_payment) {
            Storage::delete($payment->image_payment);
        }

        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
