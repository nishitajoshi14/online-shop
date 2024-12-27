<!-- coupons.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Applied Coupons</h2>

        {{-- Display the success message after applying the coupon --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Display the applied coupon code --}}
        @if(session('applied_coupon'))
            <div class="card">
                <div class="card-header">
                    Applied Coupon
                </div>
                <div class="card-body">
                    <p>Coupon Code: <strong>{{ session('applied_coupon') }}</strong></p>
                    <p>Coupon applied successfully!</p>
                </div>
            </div>
        @else
            <p>No coupon applied yet. Please apply a coupon from the cart page.</p>
        @endif
    </div>
@endsection
