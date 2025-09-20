<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of products (catalog page)
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Filter products by category
     */
    public function category($category)
    {
        $products = Product::where('category', $category)
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('products.index', compact('products'));
    }
}
