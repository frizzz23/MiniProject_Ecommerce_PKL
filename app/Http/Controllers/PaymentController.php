<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{


    public function __construct(Request $request)
    {
        // Set midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    // /**
    //  * Display a listing of the payments.
    //  */
    // public function index()
    // {
    //     // Mengambil semua pembayaran dan pesanan
    //     $payments = Payment::with('order')->get();
    //     $orders = Order::all(); // Mengambil semua pesanan (orders)

    //     return view('payments.index', compact('payments', 'orders')); // Mengirimkan payments dan orders ke view
    // }


    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;
        $order = Order::findOrFail($orderId);
        $status = 'pending';
        $status_order = 'pending';
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {

                if ($fraud == 'challenge') {
                    $status = 'pending';
                    $status_order = 'pending';
                } else {
                    $status = 'success';
                    // $status_order = 'completed';
                }
            }
        } elseif ($transaction == 'settlement') {
            $status = 'success';
            // $status_order = 'completed';
        } elseif ($transaction == 'pending') {
            $status = 'pending';
            // $status_order = 'pending';
        } elseif ($transaction == 'deny') {
            $status = 'failed';
            // $status_order = 'pending';
        } elseif ($transaction == 'expire') {
            $status = 'expired';
            // $status_order = 'pending';
        } elseif ($transaction == 'cancel') {
            $status = 'failed';
            // $status_order = 'pending';
        }
        $order->update([
            'status_order' => $status_order,
        ]);

        $order->payment->update([
            'status' => $status,
            'payment_method' => $type,
        ]);
    }

    // /**
    //  * Store a newly created payment in the database.
    //  */
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'image_payment' => 'required|image',
    //         'payment_method' => 'required|in:cash, transfer',
    //         'status' => 'required|in:pending, paid, canceled',
    //     ]);

    //     // Menyimpan pembayaran
    //     $payment = new Payment();
    //     $payment->order_id = $request->order_id;

    //     // Menyimpan gambar pembayaran
    //     if ($request->hasFile('image_payment')) {
    //         $payment->image_payment = $request->file('image_payment')->store('payments', 'public');
    //     }

    //     $payment->payment_method = $request->payment_method;
    //     $payment->save();

    //     return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dibuat.');
    // }

    // /**
    //  * Show the form for editing the specified payment.
    //  */
    // public function edit(Payment $payment)
    // {
    //     $orders = Order::all();
    //     return view('payments.edit', compact('payment', 'orders'));
    // }

    // /**
    //  * Update the specified payment in the database.
    //  */
    // public function update(Request $request, Payment $payment)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'image_payment' => 'required|image',
    //         'payment_method' => 'required|in:cash, transfer',
    //         'status' => 'required|in:pending, paid, canceled',
    //     ]);

    //     // Update pembayaran
    //     $payment->payment_method = $request->payment_method;

    //     if ($request->hasFile('image_payment')) {
    //         // Hapus gambar lama jika ada
    //         if ($payment->image_payment) {
    //             Storage::delete($payment->image_payment);
    //         }

    //         // Simpan gambar baru
    //         $payment->image_payment = $request->file('image_payment')->store('payments', 'public');
    //     }

    //     $payment->save();

    //     return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    // }

    // /**
    //  * Remove the specified payment from the database.
    //  */
    // public function destroy(Payment $payment)
    // {
    //     // Hapus pembayaran
    //     if ($payment->image_payment) {
    //         Storage::delete($payment->image_payment);
    //     }

    //     $payment->delete();

    //     return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    // }
}
