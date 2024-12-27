<!-- resources/views/user/view-order.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Order Information - Order #{{ $order->id }}</h5>
                        <a href="{{ route('user.orders') }}" class="btn btn-secondary">Back to Orders</a>
                    </div>

                    <!-- Order details table -->
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Pincode</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->fullName }}</td>
                                    <td>{{ $order->phoneNumber }}</td>
                                    <td>{{ $order->pincode }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($order->order_status === 'pending')
                                                    <span class="btn btn-info btn-sm text-white">Ordered</span>
                                                @else
                                                    {{ ucfirst($order->order_status) }}
                                                @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Address Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Shipping Address</h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr><td><strong>Full Name:</strong> {{ $order->fullName }}</td></tr>
                            <tr><td><strong>Phone:</strong> {{ $order->phoneNumber }}</td></tr>
                            <tr><td><strong>Pincode:</strong> {{ $order->pincode }}</td></tr>
                            <tr><td><strong>State:</strong> {{ $order->state }}</td></tr>
                            <tr><td><strong>City:</strong> {{ $order->city }}</td></tr>
                            <tr><td><strong>House No:</strong> {{ $order->address1 }}</td></tr>
                            <tr><td><strong>Landmark:</strong> {{ $order->landmark ?? 'N/A' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- My Cart Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Cart</h5>
    
                    @if(session()->has('cart') && !empty(session()->get('cart')))
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $productId => $product)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td>{{ $product['name'] }}</td>
                                            <td>{{ $product['quantity'] }}</td>
                                            <td>₹{{ number_format($product['price'], 2) }}</td>
                                            <td>₹{{ number_format($product['price'] * $product['quantity'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    
                        <!-- Display Cart Total -->
                        <div class="mt-3">
                            <h4>Total: ₹{{ number_format(array_sum(array_map(function($item) {
                                return $item['price'] * $item['quantity'];
                            }, session('cart'))), 2) }}</h4>
                        </div>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
<!-- Transaction Section inside Card -->
<div class="card mt-3" style="padding: 15px;">
    <!-- Title "Transaction" inside Card -->
    <h4 style="font-weight: bold; font-size: 1.25rem; margin-bottom: 15px; color: black;">Transaction</h4>
    
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Subtotal</th>
                <td>{{ $order->subtotal }}</td>
                <th>VAT</th>
                <td>{{ $order->vat }}</td>
                <th>Discount</th>
                <td>{{ $order->discount }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $order->total }}</td>
                <th>Payment Method</th>
                <td>{{ ucfirst($order->paymentMethod) }}</td>
                <th>Status</th>
                <td>
                    @if($order->order_status === 'pending')
                        <span class="btn btn-info btn-sm text-white">Pending</span>
                    @elseif($order->order_status === 'canceled')
                        <span class="btn btn-danger btn-sm text-white">Canceled</span>
                    @else
                        {{ ucfirst($order->order_status) }}
                    @endif
                </td>
                
                
            </tr>
        </tbody>
    </table>

    <!-- "Cancel Order" Button -->
    
</div>
<div class="d-flex justify-content-end mt-3">
    @if($order->order_status === 'pending' && $order->user_id === Auth::id())
    <form action="{{ route('user.order.cancel', $order->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
            Cancel Order
        </button>
    </form>
@endif


</div>    


        </div>
@endsection
