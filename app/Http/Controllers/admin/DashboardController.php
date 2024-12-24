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
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        $newuser = User::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $neworder = Order::where('status_order', 'pending')->count();

        $Revenue = Order::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status_order', 'completed')
            ->sum('grand_total_amount');

        $totalItemsSold = ProductOrder::whereHas('order', function ($query) use ($year, $month) {
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status_order', 'completed');
        })->sum('quantity');

        $period = $request->input('period', 'daily');

        // Data penjualan berdasarkan periode
        switch ($period) {
            case 'weekly':
                $salesData = $this->getWeeklySalesData($year, $month);
                break;
            case 'monthly':
                $salesData = $this->getMonthlySalesData($year, $month);
                break;
            default:
                $salesData = $this->getDailySalesData($year, $month);
                break;
        }

        // Mendapatkan data produk paling laris
        $mostOrderedProducts = ProductOrder::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'DESC')
            ->with('product')
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
                'salesData' => $salesData
            ]);
        }

        // Jika bukan AJAX, tampilkan view dengan semua data
        return view('admin.dashboard.index', compact(
            'newuser',
            'neworder',
            'Revenue',
            'totalItemsSold',
            'mostOrderedProducts',
            'salesData',
            'period',
            'month',
            'year',
            'topCategories'
        ));
    }

    // Mendapatkan data penjualan harian
    private function getDailySalesData($year, $month)
    {
        return Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(grand_total_amount) as total_sales'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)')) // Ubah ini untuk memastikan urutan yang valid
            ->get();
    }

    // Mendapatkan data penjualan mingguan
    private function getWeeklySalesData($year, $month)
    {
        return Order::select(DB::raw('WEEK(created_at) as week'), DB::raw('SUM(grand_total_amount) as total_sales'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('WEEK(created_at)')) // Ubah ini untuk memastikan urutan yang valid
            ->get();
    }


    // Mendapatkan data penjualan bulanan
    private function getMonthlySalesData($year, $month)
    {
        return Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(grand_total_amount) as total_sales'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)')) // Ubah ini untuk memastikan urutan yang valid
            ->get();
    }

    public function salesChart(Request $request)
    {
        $period = $request->input('period', 'daily');
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Periksa periode dan ambil data sesuai
        switch ($period) {
            case 'weekly':
                $salesData = $this->getWeeklySalesData($year, $month);
                break;
            case 'monthly':
                $salesData = $this->getMonthlySalesData($year, $month);
                break;
            default:
                $salesData = $this->getDailySalesData($year, $month);
                break;
        }

        return response()->json($salesData);
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
