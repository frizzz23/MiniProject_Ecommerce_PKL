<?php

namespace App\Http\Controllers\Page;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   
        $limit = 6;
        $categories = Category::limit($limit)->get();
        $products = Product::get();
        return view('page.product', compact('products','categories','limit'));
    }
}
