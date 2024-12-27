<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Import the Category model
use App\Models\Brand; // Import the Brand model
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::withCount('products')->get();
    $brands = Brand::withCount('products')->get();

    // Get selected category IDs from the request
    $selectedCategories = $request->input('categories', []);
    $selectedBrands = $request->input('brands', []);

    // Fetch products based on selected categories and brands
    $products = Product::when($selectedCategories, function ($query) use ($selectedCategories) {
        return $query->whereIn('category_id', $selectedCategories);
    })->when($selectedBrands, function ($query) use ($selectedBrands) {
        return $query->whereIn('brand_id', $selectedBrands);
    })->paginate(12); // Adjust pagination as needed

    return view('shop', compact('categories', 'products', 'brands'));
}




    public function show($id)
    {
        // Retrieve the product by its ID
        $product = Product::findOrFail($id);

        // Return the product details view
        return view('product.show', compact('product'));
    }

    
}
