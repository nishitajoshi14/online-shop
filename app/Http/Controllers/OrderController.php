<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cartitem;

class OrderController extends Controller
{
    public function success()
    {
        return view('order.success');
    }

    public function index()
    {
        // Fetch orders and order them by 'created_at' in descending order to show new orders first
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        // Return the view with the paginated orders
        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        // Retrieve the order
        $order = Order::findOrFail($id);

        // Fetch all cart items from the cart_items table
        $cartItems = CartItem::all(); // Retrieves all items in cart_items table

        // Pass the order and all cart items to the view
        return view('admin.order-details', compact('order', 'cartItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Fetch the order by ID
        $order = Order::findOrFail($id);
    
        // Update the order status
        $order->order_status = $request->input('order_status');
        $order->save();
    
        // Redirect back with a success message
        return redirect()->route('orders.show', $id)->with('status', 'Order status updated successfully!');
    }
    
    


}
