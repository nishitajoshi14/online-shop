<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Register;
use App\Models\Login;
use App\Models\Cart;
use App\Models\CartItem;


class UserController extends Controller
{
    public function orders()
    {
        $username = session('username'); // Get the username from the session
        $orders = Order::where('fullName', $username)->get(); 
        return view('user.orders', compact('orders'));
    }

    

    public function viewOrder($orderId)
{
    if (Session::has('user')) {
        // Fetch the specific order using the order ID
        $order = Order::findOrFail($orderId);

        // Fetch cart items for the logged-in user
        $cartItems = CartItem::where('user_id', Session::get('user')->id)->get();

        // Pass both order and cartItems to the view
        return view('user.view-order', compact('order', 'cartItems'));
    }

    return redirect()->route('login.form')->with('error', 'Please log in first.');
}

public function previousProducts()
{
    // Fetch the logged-in user's ID from the session
    $userId = session('user_id'); // Ensure you are storing 'user_id' in the session during login

    // Fetch products from `cart_items` for the logged-in user
    $previousProducts = DB::table('cart_items')
        ->join('products', 'cart_items.product_id', '=', 'products.id') // Join with the `products` table
        ->select('cart_items.*', 'products.image') // Include product image from `products` table
        ->where('cart_items.user_id', $userId) // Filter by user ID
        ->get();

    return view('user.previous-products', ['previousProducts' => $previousProducts]);
}    
    public function accountDetails()

    {
        // Get the logged-in user's username from session
        $username = Session::get('username');

        // Fetch orders where 'fullName' matches the username
        $orders = Order::where('fullName', $username)->get();

        // Pass the orders to the view
        return view('user.account-detalis', compact('orders'));
    }

    public function updateAccount(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            'pincode' => 'required|string|max:10',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
        ]);

        // Find the order by ID and update it
        $order = Order::findOrFail($id);
        $order->update($validated);

        // Redirect back to the account details page with a success message
        return redirect()->route('user.accountdetails')->with('success', 'Account details updated successfully!');
    }

    public function settings()
    {
        return view('user.settings');
    }

    public function showCoupons()
    {
        return view('user.coupons'); // Display the applied coupon code
    }

    public function applyCoupon(Request $request)
{
    // Ensure the user is logged in before applying a coupon
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You need to log in to apply a coupon.');
    }

    // Get the logged-in user's ID
    $userId = auth()->id();

    // Retrieve the coupon code from the request
    $couponCode = $request->input('coupon_code');

    // Validate the coupon code (fetch it from the database)
    $coupon = Coupon::where('code', $couponCode)->first();

    if (!$coupon) {
        return redirect()->back()->with('error', 'Invalid coupon code');
    }

    // Store the coupon information in the session for this specific user
    session()->put("user_{$userId}_coupon", [
        'code' => $coupon->code,
        'discount' => $coupon->discount_value,
    ]);

    // Optionally, return a success message
    return redirect()->back()->with('success', 'Coupon applied successfully');
}
    
    public function profile()
    {
        // Retrieve the logged-in user's ID from session
        $userId = session('user_id');
        $user = Register::find($userId);

        // Pass the user data to the view
        return view('user.profile', compact('user'));
    }

    public function logout(Request $request)
{
    // Forget all session data related to the user and cart
    $request->session()->forget(['user_id', 'username', 'email', 'cart']);

    return redirect()->route('home')->with('success', 'Logged out successfully!');
}


public function cancelOrder($id)
    {
        // Fetch the order by ID and make sure it belongs to the logged-in user
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();

        // Check if the order exists and is pending
        if ($order && $order->order_status === 'pending') {
            // Update the status to 'canceled'
            $order->order_status = 'canceled';
            $order->save();

            // Redirect back with success message
            return redirect()->route('user.viewOrder', $id)->with('status', 'Your order has been canceled successfully.');
        }

        // If order is not found, not pending, or not the user's order, return with an error message
        return redirect()->route('user.viewOrder', $id)->with('error', 'Order could not be canceled or you do not have permission to cancel this order.');
    }

}