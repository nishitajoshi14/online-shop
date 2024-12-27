<?php

// app/Http/Controllers/CouponController.php
namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.coupons', compact('coupons'));
    }

    public function create()
    {
        return view('admin.add-coupon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons,coupon_code',
            'coupon_type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'cart_value' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('status', 'Coupon added successfully!');
    }

    public function edit(Coupon $coupon)
{
    return view('admin.edit-coupon', compact('coupon'));
}

public function update(Request $request, Coupon $coupon)
{
    $request->validate([
        'coupon_code' => 'required|unique:coupons,coupon_code,' . $coupon->id,
        'coupon_type' => 'required',
        'value' => 'required|numeric',
        'cart_value' => 'required|numeric',
        'expiry_date' => 'required|date',
    ]);

    $coupon->update($request->all());

    return redirect()->route('coupons.index')->with('status', 'Coupon updated successfully.');
}


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('status', 'Coupon deleted successfully!');
    }

    // app/Http/Controllers/CouponController.php
    public function verify(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
    
        if ($coupon) {
            // Check if the coupon is expired
            $currentDate = now();
            if ($coupon->expiry_date < $currentDate) {
                return response()->json([
                    'valid' => false,
                    'message' => 'This coupon has expired.',
                ]);
            }
    
            return response()->json([
                'valid' => true,
                'discount_value' => $coupon->value, // Assuming value is percentage or fixed
            ]);
        }
    
        return response()->json([
            'valid' => false,
            'message' => 'Invalid coupon code.',
        ]);
    }

    
    
}
