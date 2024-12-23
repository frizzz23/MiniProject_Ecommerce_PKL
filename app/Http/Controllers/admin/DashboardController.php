<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $month = $request->input('month', now()->format('m')); // Default ke bulan saat ini
        $year = $request->input('year', now()->format('Y'));  // Default ke tahun saat ini

        $newuser = User::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $neworder = Order::where('status_order', 'pending')->count();
        $Revenue = Order::whereYear('created_at', $year) // Filter berdasarkan tahun
            ->whereMonth('created_at', $month) // Filter berdasarkan bulan
            ->where('status_order', 'completed') // Hanya menghitung order yang selesai
            ->sum('grand_total_amount'); // Jumlahkan total pendapatan

        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Menghitung total barang yang terjual berdasarkan bulan dan tahun
        $totalItemsSold = ProductOrder::whereHas('order', function ($query) use ($year, $month) {
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status_order', 'completed'); // Hanya menghitung order yang sudah selesai
        })
            ->sum('quantity'); // Jumlahkan seluruh quantity produk yang terjual

        $mostOrderedProducts = ProductOrder::select('product_id', ProductOrder::raw('SUM(quantity) as total_quantity'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'DESC')
            ->with('product')
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact('newuser', 'neworder', 'Revenue', 'totalItemsSold', 'mostOrderedProducts', 'month', 'year'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
