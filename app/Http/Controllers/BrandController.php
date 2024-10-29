<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    // Show create brand form
    public function create()
    {
        return view('admin.add-brand'); // Ensure this points to your form view
    }

    public function index(Request $request)
{
    // Get the search term from the request
    $searchTerm = $request->search;

    // Check if there's a search term and filter brands based on it
    $query = Brand::query();
    if ($searchTerm) {
        $query->where('name', 'LIKE', '%' . $searchTerm . '%');
    }

    // Get filtered or all brands
    $brands = $query->get();

    // Pass both the brands and search term to the view
    return view('admin.brands', compact('brands', 'searchTerm'));
}


    // Store a new brand
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('brand_image')) {
            $path = $request->file('brand_image')->store('images/brands', 'public'); // Store the image in the public storage
        }

        // Create a new brand instance and save it to the database
        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_image' => $path ?? null,
        ]);

        return redirect()->route('brands.index')->with('status', 'Brand created successfully!');
    }

    // Show edit brand form
    public function edit($id)
    {
        $brand = Brand::findOrFail($id); // Find the brand by ID
        return view('admin.edit-brand', compact('brand')); // Show the edit form with brand data
    }

    // Update the brand
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'brand_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload if there's a new image
        if ($request->hasFile('brand_image')) {
            // Delete the old image if it exists
            if ($brand->brand_image) {
                Storage::disk('public')->delete($brand->brand_image);
            }

            $path = $request->file('brand_image')->store('images/brands', 'public');
            $brand->brand_image = $path;
        }

        // Update the brand data
        $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_image' => $brand->brand_image ?? $brand->brand_image,
        ]);

        return redirect()->route('brands.index')->with('status', 'Brand updated successfully!');
    }

    // Delete the brand
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        // Delete the image if it exists
        if ($brand->brand_image) {
            Storage::disk('public')->delete($brand->brand_image);
        }

        // Delete the brand
        $brand->delete();

        return redirect()->route('brands.index')->with('status', 'Brand deleted successfully!');
    }
}
