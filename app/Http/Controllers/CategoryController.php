<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    // Initialize the query
    $query = Category::query();

    // Check if there's a search term
    if ($request->has('search') && $request->search !== '') {
        $searchTerm = $request->search;
        // Filter categories based on the search term
        $query->where('name', 'LIKE', '%' . $searchTerm . '%');
    }

    // Fetch the filtered categories
    $categories = $query->get(); // Use get() instead of all() to apply filters

    return view('admin.categories', compact('categories'));
}


    public function create()
    {   
        return view('admin.add-category');
    }

    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
        }

        // Create category
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('status', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'category_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        // Handle image upload
        $imagePath = $category->category_image;
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
        }

        // Update category
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('status', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category deleted successfully!');
    }

    // In CheckoutController.php
public function placeOrder(Request $request)
{
    // Validate and create order data
    $order = Order::create([
        'fullName' => $request->input('fullName'),
        'phoneNumber' => $request->input('phoneNumber'),
        'pincode' => $request->input('pincode'),
        'state' => $request->input('state'),
        'city' => $request->input('city'),
        'address1' => $request->input('address1'),
        'landmark' => $request->input('landmark'),
        'total' => $request->input('total'),
        'order_status' => 'pending',
    ]);

    // Assuming $request->input('products') is an array of products with quantities
    $products = $request->input('products'); // [product_id => quantity]

    foreach ($products as $productId => $quantity) {
        $product = Product::find($productId);
        if ($product) {
            $order->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }
    }

    return redirect()->route('user.orders')->with('success', 'Order placed successfully!');
}

}
