@extends('layouts.app') <!-- Inherit layout from app.blade.php -->

@section('title', 'Shop')

@section('content')
<div class="shop-container">
    
    <!-- Horizontal Card Section Above the Title -->
    <div class="d-flex justify-content-between mb-4 align-items-start">
        <!-- Title for Product Categories -->
        <h2 style="margin-left: 10px; margin-right: 20px; font-size: 1.5rem; font-weight: 600;">PRODUCT CATEGORIES</h2>
        
        <div class="card d-flex flex-row align-items-center" style="width: 80%; max-width: 800px; height: 450px; background-color: #f8f9fa;">
            <!-- Text Section (Left Aligned with Equal Padding) -->
            <div class="d-flex flex-column justify-content-center" style="flex: 1; padding: 0 30px 0 30px; text-align: left;">
                <p style="font-size: 2.5rem; font-weight: 400; margin: 0;">WOMEN'S</p>
                <p style="font-size: 3.0rem; font-weight: 800; margin: 0;">ACCESSORIES</p>
                <!-- Add description paragraph below the titles -->
                <p style="font-size: 1rem; font-weight: 400; margin: 0;">Accessories are the best way to update your look. Add a title edge with new styles and new colors, or go for timeless pieces.</p>
            </div>
            <!-- Image Section (Right) -->
            <div>
                <img src="{{ asset('assets/images/shop_banner3.jpg') }}" alt="Women's Accessories" style="width: 400px; height: 450px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Shop Title -->
    <h1 class="text-center mb-5">Welcome to Our Shop</h1>

    <!-- Product Section -->
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ $product->price }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination (if you want to paginate products) -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
