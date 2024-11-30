<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $limit = 6;
        $categories = Category::limit($limit)->get();
        $products = Product::with('images')->latest()->limit($limit)->get();
        return view('landing-page', compact('categories', 'products', 'limit'));
    }
}
