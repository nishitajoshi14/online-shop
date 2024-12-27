<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar p-0">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile')}}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.orders') }}">
                            <i class="fas fa-box"></i> Orders
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.accountdetails') }}">
                            <i class="fas fa-address-card"></i> Account Details
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.coupons')}}">
                            <i class="fas fa-tag"></i> Coupons
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Title at the Top -->
            <h1 class="h2 m-0">Dashboard</h1>

            <!-- Row for Cards with top margin -->
            <div class="row row-cols-1 row-cols-md-3 g-0 mt-4"> <!-- 'mt-4' for top margin -->
                <!-- Cart Summary Card -->
                <div class="col mt-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title">Cart Summary</h5>
                            <p class="card-text">
                                @php
                                    $cartItems = session()->get('cart', []);
                                    $totalItems = array_sum(array_column($cartItems, 'quantity'));
                                    $totalPrice = array_sum(array_map(function($item) {
                                        return $item['quantity'] * $item['price'];
                                    }, $cartItems));
                                @endphp
                                <strong>Total Items:</strong> {{ $totalItems }}<br>
                                <strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}
                            </p>
                            <a href="{{ route('cart.show') }}" class="btn btn-primary">View Cart</a>
                        </div>
                    </div>
                </div>

                <!-- Order History Card -->
                <div class="col mt-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title">Order History</h5>
                            <p class="card-text">View your past orders and their statuses.</p>
                            <a href="{{ route('user.previousProducts') }}" class="btn btn-primary">View Orders</a>
                        </div>
                    </div>
                </div>
                
                <!-- Account Settings Card -->
                <div class="col mt-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title">Account Settings</h5>
                            <p class="card-text">Manage your personal information, addresses, and more.</p>
                            <a href="{{route('user.profile')}}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message and Overview Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title">Welcome, {{ session('username') }}</h5>
                            <p class="card-text">
                                We're glad to have you here! Check out your recent activities, view account updates, and more.
                            </p>
                            <a href="{{ route('shop.index') }}" class="btn btn-success">Go to Shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
