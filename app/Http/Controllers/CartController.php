<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Session;
use App\Models\CartItem;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $productImage = $product->image ?? 'default-image.jpg';

        $cart = session()->get('cart', []);

        // If product is already in session cart, increase its quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Add new product to session cart
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => 1,
                'image' => $productImage,
            ];
        }

        session()->put('cart', $cart);

        // Save to the database
        CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'product_name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => $cart[$productId]['quantity'],
                'image' => $productImage,
            ]
        );

        $cartCount = array_sum(array_column($cart, 'quantity'));

        if ($request->ajax()) {
            return response()->json(['cartCount' => $cartCount]);
        }

        return redirect()->route('shop.index');
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function update(Request $request, $index)
    {
        $cart = session()->get('cart');

        if ($cart && isset($cart[$index])) {
            $cart[$index]['quantity'] = max(1, (int) $request->input('quantity'));
            session()->put('cart', $cart);

            // Update the database as well
            $cartItem = CartItem::where('user_id', Auth::id())->where('product_id', $cart[$index]['id'])->first();
            if ($cartItem) {
                $cartItem->quantity = $cart[$index]['quantity'];
                $cartItem->save();
            }
        }

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully.');
    }

    public function remove($index)
    {
        $cart = session()->get('cart');

        if ($cart && isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', $cart);

            // Remove the item from the database as well
            CartItem::where('user_id', Auth::id())->where('product_id', $index)->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
    }



// Inside CartController after applying the coupon
public function applyCoupon(Request $request)
{
    $couponCode = $request->input('coupon_code');
    $coupon = Coupon::where('coupon_code', $couponCode)->first();

    if ($coupon) {
        // Example: Calculate the discount
        $discount = $coupon->value; // You can modify this logic as per your coupon rules
        
        // Store the discount value in session
        session()->put('discount', $discount);

        return response()->json([
            'valid' => true,
            'discount' => $discount,
        ]);
    }

    return response()->json([
        'valid' => false,
    ]);
}



}
