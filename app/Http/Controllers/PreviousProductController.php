<?php

namespace App\Http\Controllers;

use App\Models\PreviousProduct;
use Illuminate\Http\Request;

class PreviousProductController extends Controller
{
    // Add a product to the previous_products table
    public function addToPreviousProducts(Request $request)
    {
        // Retrieve the cart items from the session
        $cartItems = session()->get('cart', []);
        $username = session('username');

        foreach ($cartItems as $item) {
            // Save each cart item to the previous_products table
            PreviousProduct::create([
                'username' => $username,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image_url' => $item['image'],
            ]);
        }

        // Do not clear the cart, so the products remain visible in the cart
        // session()->forget('cart');  // Remove this line to keep cart items

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Products added to your order history.');
    }

    // Display the previous products for the logged-in user
    public function viewPreviousProducts()
    {
        $username = session('username');
        $previousProducts = PreviousProduct::where('username', $username)->get();

        return view('user.previous-products', compact('previousProducts'));
    }
}
