<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment; // Ensure the Payment model is imported
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function showPaymentPage(Request $request)
    {
        $total = session('order_id') ? \App\Models\Order::find(session('order_id'))->total : 0;
        return view('payment', compact('total'));
    }

    public function processPayment(Request $request)
    {
        try {
            $amount = $request->input('amount') * 100; // Convert to cents
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            // Store payment in the database
            $payment = Payment::create([
                'user_id' => auth()->id() ?? 0, // Adjust if not using auth
                'payment_id' => $paymentIntent->id,
                'amount' => $request->input('amount'),
                'status' => 'pending',
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function payNow(Request $request)
    {
        $payment = Payment::where('payment_id', $request->input('payment_id'))->first();
        if ($payment) {
            $payment->update(['status' => 'succeeded']);
        }

        return response()->json(['status' => 'Payment updated']);
    }
}
