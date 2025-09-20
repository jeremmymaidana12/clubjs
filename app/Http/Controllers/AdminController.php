<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Product::distinct('category')->count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        $totalValue = Product::sum('price');

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'lowStockProducts', 'totalValue'));
    }

    /**
     * Display a listing of products for admin
     */
    public function products(Request $request)
    {
        $query = Product::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Stock filter
        if ($request->filled('stock_filter')) {
            switch ($request->stock_filter) {
                case 'low':
                    $query->where('stock', '<', 10);
                    break;
                case 'out':
                    $query->where('stock', 0);
                    break;
            }
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);

        // Preserve query parameters in pagination links
        $products->appends($request->query());

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function createProduct()
    {
        $categories = Product::distinct('category')->pluck('category');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $productData = $request->except('image');

        // Handle image upload using helper
        if ($request->hasFile('image') && ImageHelper::isValidImage($request->file('image'))) {
            $productData['image'] = ImageHelper::uploadProductImage($request->file('image'));
        }

        Product::create($productData);

        return redirect()->route('admin.products')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Show the form for editing a product
     */
    public function editProduct(Product $product)
    {
        $categories = Product::distinct('category')->pluck('category');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $productData = $request->except('image');

        // Handle image upload using helper
        if ($request->hasFile('image') && ImageHelper::isValidImage($request->file('image'))) {
            $productData['image'] = ImageHelper::uploadProductImage(
                $request->file('image'),
                $product->image // Pass old image for deletion
            );
        }

        $product->update($productData);

        return redirect()->route('admin.products')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified product
     */
    public function deleteProduct(Product $product)
    {
        // Delete image using helper
        if ($product->image) {
            ImageHelper::deleteProductImage($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Show categories management
     */
    public function categories()
    {
        $categories = Product::select('category')
            ->selectRaw('COUNT(*) as products_count')
            ->selectRaw('SUM(stock) as total_stock')
            ->selectRaw('AVG(price) as avg_price')
            ->groupBy('category')
            ->get();

        return view('admin.categories', compact('categories'));
    }

    /**
     * Update category name
     */
    public function updateCategory(Request $request)
    {
        $request->validate([
            'old_category' => 'required|string',
            'new_category' => 'required|string|max:255',
        ]);

        Product::where('category', $request->old_category)
            ->update(['category' => $request->new_category]);

        return redirect()->route('admin.categories')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Delete category and all its products
     */
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
        ]);

        Product::where('category', $request->category)->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Categoría y todos sus productos eliminados exitosamente.');
    }
}
