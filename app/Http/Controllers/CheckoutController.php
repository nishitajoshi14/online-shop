<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;



class CheckoutController extends Controller
{
    private function calculateCartSummary($cart)
{
    // Calculate subtotal (sum of price * quantity for each cart item)
    $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    // Calculate discount value (10% of subtotal)
    $discount = $subtotal * 0.1;

    // Calculate VAT as per the user's request: VAT = subtotal - discountValue * 0.1
    $vat = ($subtotal - $discount) * 0.1;

    // Shipping cost (static, free shipping in this case)
    $shippingCost = 0;

    // Calculate the subtotal after discount
    $subtotalAfterDiscount = $subtotal - $discount;

    // Calculate total (subtotal after discount + VAT + shipping cost)
    $total = $subtotalAfterDiscount + $vat + $shippingCost;

    // Return all necessary values to be used in the view
    return compact('subtotal', 'vat', 'discount', 'shippingCost', 'total');
}





    // Cart summary page
    public function cartSummary()
    {
        $cart = session()->get('cart', []);
        $summary = $this->calculateCartSummary($cart);
        
        return view('cart', array_merge(['cart' => $cart], $summary));
    }

    // Checkout page
    public function index()
    {
        $cart = session()->get('cart', []);
        $summary = $this->calculateCartSummary($cart);
        
        return view('checkout', array_merge(['cart' => $cart], $summary));
    }

    public function process(Request $request)
{
    $cart = session()->get('cart', []);
    
    if (!$cart || count($cart) == 0) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }

    $summary = $this->calculateCartSummary($cart);
    
    // Handle the selected payment method
    $paymentMethod = $request->input('payment_method'); // Retrieve the selected payment method
    // You can save this to the database or handle the logic for each method here

    // Additional processing can be done here, like storing the order details.

    return view('checkout', array_merge(['cart' => $cart], $summary));
}

public function store(Request $request)
{
    // Validate the incoming data
    $validated = $request->validate([
        'fullName' => 'required|string',
        'phoneNumber' => 'required|string',
        'pincode' => 'required|string',
        'state' => 'required|string',
        'city' => 'required|string',
        'address1' => 'required|string',
        'address2' => 'required|string',
        'landmark' => 'nullable|string',
        'paymentMethod' => 'required|string',
    ]);

    // Get the cart from session
    $cart = session()->get('cart', []);

    // Calculate cart summary (subtotal, discount, vat, total)
    $summary = $this->calculateCartSummary($cart);

    // Store the order in the database
    $order = Order::create([
        'fullName' => $validated['fullName'],
        'phoneNumber' => $validated['phoneNumber'],
        'pincode' => $validated['pincode'],
        'state' => $validated['state'],
        'city' => $validated['city'],
        'address1' => $validated['address1'],
        'address2' => $validated['address2'],
        'landmark' => $validated['landmark'],
        'paymentMethod' => $validated['paymentMethod'],
        'subtotal' => $summary['subtotal'],
        'discount' => $summary['discount'],
        'vat' => $summary['vat'],
        'total' => $summary['total'],
        'order_status' => 'pending', // or another status based on your business logic
    ]);

    // Optionally, clear the cart after placing the order
    session()->forget('cart');

    session()->put('order_id', $order->id);


    // Redirect to a confirmation page or success page
    return redirect()->route('payment.show', ['order' => $order->id]);
}



}
