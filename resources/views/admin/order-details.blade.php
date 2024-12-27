@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            <!-- Header -->
            @include('admin.header')

            <!-- Title Section with Breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Order Details</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>

            <div class="card mt-3" style="padding: 10px;">
                <!-- Back Button at Top Right -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('orders.index') }}" class="btn" style="border: 1px solid #007bff; color: #007bff; background-color: transparent; width:150px;">
                        Back
                    </a>
                </div>

                <table class="table table-bordered">
                    <tbody>
                        <!-- First Row: Order No, Full Name, and Phone -->
                        <tr>
                            <th>Order No</th>
                            <td>{{ $order->id }}</td>
                            <th>Full Name</th>
                            <td>{{ $order->fullName }}</td>
                            <th>Phone</th>
                            <td>{{ $order->phoneNumber }}</td>
                        </tr>

                        <!-- Second Row: Pin Code, Order Date, and Status -->
                        <tr>
                            <th>Pin Code</th>
                            <td>{{ $order->pincode }}</td>
                            <th>Order Date</th>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <th>Status</th>
                            <td>{{ ucfirst($order->order_status) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Shipping Address Section inside Card -->
            <div class="card mt-3" style="padding: 15px;">
                <!-- Title "Shipping Address" inside Card -->
                <h4 style="font-weight: bold; font-size: 1.25rem; margin-bottom: 15px; color: black;">Shipping Address</h4>
                
                <div class="mt-3" style="font-size: 1rem; color: black;">
                    <div><strong>{{ $order->fullName }}</strong></div>
                    <div>{{ $order->phoneNumber }}</div>
                    <div>{{ $order->pincode }}</div>
                    <div>{{ $order->state }}</div>
                    <div>{{ $order->city }}</div>
                    <div>{{ $order->house_no }}</div>
                    <div>{{ $order->road_name }}</div>
                    <div>{{ $order->landmark }}</div>
                </div>
            </div>

            <!-- Cart Items Section inside Card -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            
            
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
                                @if($order->order_status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($order->order_status == 'delivered')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($order->order_status == 'canceled')
                                    <span class="badge badge-danger">Canceled</span>
                                @endif
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>


            <!-- Update Order Status Section -->
            <div class="card mt-3" style="padding: 15px;">
                <h4 style="font-weight: bold; font-size: 1.25rem; margin-bottom: 15px; color: black;">Update Order Status</h4>
            
                <form action="{{ route('admin.updateOrderStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group mb-0">
                            <select name="order_status" class="form-control" style="width: 200px;">
                                <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="canceled" {{ $order->order_status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 150px; margin-left: 10px;">Update Status</button>
                    </div>
                </form>
            </div>
                        
        </main>
    </div>
</div>
@endsection
