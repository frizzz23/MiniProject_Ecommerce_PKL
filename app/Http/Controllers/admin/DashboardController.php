<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan input bulan dan tahun
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Menghitung jumlah pengguna baru dengan peran 'user' pada bulan dan tahun tertentu
        $newuser = User::role('user') // Hanya pengguna dengan peran 'user'
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        // Menghitung jumlah pesanan dengan status 'pending'
        $neworder = Order::where('status_order', 'pending')->count();

        // Menghitung total pendapatan dari pesanan yang selesai
        $Revenue = Order::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status_order', 'completed')
            ->sum('grand_total_amount');

        // Menghitung total barang terjual dari pesanan yang selesai
        $totalItemsSold = ProductOrder::whereHas('order', function ($query) use ($year, $month) {
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status_order', 'completed');
        })->sum('quantity');

        $mostOrderedProducts = ProductOrder::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->join('orders', 'product_orders.order_id', '=', 'orders.id')  // Menambahkan join dengan tabel orders
            ->whereYear('orders.created_at', $year)  // Pastikan mengambil data berdasarkan tahun pesanan
            ->whereMonth('orders.created_at', $month)  // Pastikan mengambil data berdasarkan bulan pesanan
            ->where('orders.status_order', 'completed')  // Pastikan menggunakan kolom status_order
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'DESC')
            ->with('product')  // Menambahkan relasi ke produk
            ->take(10)
            ->get();


        // Mendapatkan kategori produk terlaris
        $topCategories = Category::select('name_category', DB::raw('SUM(product_orders.quantity) as total_quantity'))
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_orders', 'products.id', '=', 'product_orders.product_id')
            ->join('orders', 'product_orders.order_id', '=', 'orders.id')
            ->whereYear('orders.created_at', $year)
            ->whereMonth('orders.created_at', $month)
            ->where('orders.status_order', 'completed')
            ->groupBy('name_category')
            ->orderBy('total_quantity', 'DESC')
            ->take(10)
            ->get();

        // Jika request AJAX, kembalikan hanya data yang diperlukan
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'mostOrderedProducts' => $mostOrderedProducts,
                'topCategories' => $topCategories,
                'newuser' => $newuser,
                'neworder' => $neworder,
                'Revenue' => $Revenue,
                'totalItemsSold' => $totalItemsSold,
            ]);
        }

        // Jika bukan AJAX, tampilkan view dengan semua data
        return view('admin.dashboard.index', compact(
            'newuser',
            'neworder',
            'Revenue',
            'totalItemsSold',
            'mostOrderedProducts',
            'month',
            'year',
            'topCategories'
        ));
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
