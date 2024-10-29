<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        // Retrieve paginated products for the shop page
        $products = Product::paginate(12); // Adjust the number of items per page as needed

        // Return the shop view with the products data
        return view('shop', compact('products'));
    }

    public function show($id)
{
    // Retrieve the product by its ID
    $product = Product::findOrFail($id);

    // Return the product details view
    return view('product.show', compact('product'));
}

}

//assets/images/shop_banner3.jpg