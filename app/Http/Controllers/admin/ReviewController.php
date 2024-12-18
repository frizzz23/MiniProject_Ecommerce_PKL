<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        // Mengambil semua ulasan produk beserta informasi produk dan user
        $reviews = Review::with(['product', 'user'])->get();
        $products = Product::all(); // Ambil semua produk yang tersedia
        $users = User::all(); // Ambil semua pengguna

        return view('admin.reviews.index', compact('reviews', 'product', 'products', 'users'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(Product $product)
    {
        // $users = User::all();
        // $products = Product::all();

        // return view('admin.reviews.create', compact('product', 'products', 'users'));
    }

    /**
     * Store a newly created review in the database.
     */
    public function store(Request $request)
    {
        // // Validasi input
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id',
        //     'rating' => 'required|in:1,2,3,4,5',
        //     'comment' => 'nullable|string',
        // ]);

        // Review::create([
        //     'user_id' => Auth::id(),
        //     'product_id' => $request->product_id,
        //     'rating' => $request->rating,
        //     'comment' => $request->comment,
        // ]);

        // return redirect()->route('admin.reviews.index', ['product' => $request->product_id])->with('success', 'Ulasan berhasil ditambahkan.');
    }



    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        // $users = User::all();
        // $products = Product::all();
        // return view('admin.reviews.edit', compact('review', 'products', 'users'));
    }

    /**
     * Update the specified review in the database.
     */
    public function update(Request $request, Review $review)
    {
        // // Validasi input
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id',
        //     'rating' => 'required|in:1,2,3,4,5',
        //     'comment' => 'nullable|string',
        // ]);

        // // Memperbarui ulasan
        // $review->user_id = Auth::id();
        // $review->product_id = $review->product_id;
        // $review->rating = $request->rating;
        // $review->comment = $request->comment;
        // $review->save();

        // return redirect()->route('admin.reviews.index', $review->product_id)->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Remove the specified review from the database.
     */
    public function destroy(Review $review)
    {
        // $productId = $review->product_id;
        // $review->delete();

        // return redirect()->route('admin.reviews.index', $productId)->with('success', 'Ulasan berhasil dihapus.');
    }
}
