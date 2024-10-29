<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    // Show the form to create a new product
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.add-product', compact('categories', 'brands'));
    }

    // Display the product listing with search functionality
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply search if exists
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->get(); // Get all products
        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:products,slug|max:255',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'sku' => 'required|string|max:100',
        'quantity' => 'required|integer',
        'in_stock' => 'boolean',
        'featured' => 'boolean',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->sku = $request->sku;
    $product->quantity = $request->quantity;
    $product->in_stock = $request->in_stock;
    $product->featured = $request->featured;

    // Handle image upload
    if ($request->hasFile('product_image')) {
        $filename = time() . '_' . uniqid() . '.' . $request->file('product_image')->getClientOriginalExtension();
        $path = $request->file('product_image')->storeAs('public/products', $filename); // Store in 'public/products'
        $product->image = 'products/' . $filename; // Store only relative path
    }

    // Handle gallery images
    if ($request->hasFile('gallery_images')) {
        $gallery = [];
        foreach ($request->file('gallery_images') as $file) {
            $galleryFilename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $galleryFilename); // Store in 'public/products'
            $gallery[] = 'products/' . $galleryFilename; // Store only relative path
        }
        $product->gallery_images = json_encode($gallery);
    }

    $product->save();

    return redirect()->route('admin.products.index')->with('status', 'Product added successfully!');
}

    // Show the form for editing a product
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the product or fail if not found
        $categories = Category::all(); // Fetch all categories
        $brands = Brand::all(); // Fetch all brands

        return view('admin.edit-product', compact('product', 'categories', 'brands')); // Pass product, categories, and brands to the view
    }

    // Update the specified product
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'sku' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'in_stock' => 'required|boolean',
            'featured' => 'required|boolean',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id); // Find the product

        // Update the product fields
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->sku = $request->sku;
        $product->quantity = $request->quantity;
        $product->in_stock = $request->in_stock;
        $product->featured = $request->featured;

        // Handle image upload if provided
        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            // Store new image
            $filename = time() . '_' . uniqid() . '.' . $request->file('product_image')->getClientOriginalExtension();
            $path = $request->file('product_image')->storeAs('public', $filename);
            $product->image = $filename;
        }

        $product->save(); // Save the updated product

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully!'); // Redirect back with a success message
    }

    // Delete the specified product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Optionally delete the image and gallery images from storage
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $oldGalleryImages = json_decode($product->gallery_images);
        if ($oldGalleryImages) {
            foreach ($oldGalleryImages as $oldImage) {
                Storage::delete('public/' . $oldImage);
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully!');
    }
}
