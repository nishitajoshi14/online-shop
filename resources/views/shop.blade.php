@extends('layouts.app') <!-- Inherit layout from app.blade.php -->

@section('title', 'Shop')

@section('content')
<div class="shop-container">
    <div class="row">
        <!-- Left Section (Categories, Color, Brands, Sizes, Price) -->
        <div class="col-md-3">
            <form id="filter-form" method="GET" action="{{ route('shop.index') }}">
                <!-- Product Categories Section -->
                <h2 style="margin: 0px; font-size: 1.5rem; font-weight: 600;">PRODUCT CATEGORIES</h2>
                <div class="mb-4" style="margin-top: 15px;">
                    @foreach ($categories as $category)
                        <div class="form-check" style="margin-top: 20px;">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="form-check-label" for="category-{{ $category->id }}">
                                {{ $category->name }}
                                <span style="padding-left: 100px; font-weight: 400;">{{ $category->products_count }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Brands Section -->
                <h2 style="font-size: 1.5rem; font-weight: 600; margin-top: 100px;">BRANDS</h2>
                <div class="mb-4" style="margin-top: 15px;">
                    @foreach ($brands as $brand)
                        <div class="form-check" style="margin-top: 20px;">
                            <input class="form-check-input" type="checkbox" name="brands[]" id="brand-{{ $brand->id }}" value="{{ $brand->id }}" {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                {{ $brand->name }}
                                <span style="padding-left: 100px; font-weight: 400;">{{ $brand->products_count }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>

            <!-- Color Section -->
            <h2 style="font-size: 1.5rem; font-weight: 600; margin-top: 100px;">COLOR</h2>
            <div class="d-flex flex-wrap" style="margin-top: 15px;">
                @foreach (uniqueColors() as $index => $color)
                    <div style="margin: 5px;">
                        <input type="radio" id="color-{{ $index }}" name="color" style="display: none;" value="{{ $color }}">
                        <label for="color-{{ $index }}" class="color-radio" 
                               style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: {{ $color }}; cursor: pointer; border: 2px solid transparent;">
                        </label>
                    </div>
                    @if (($index + 1) % 7 == 0) <!-- New row after 7 colors -->
                        </div><div class="d-flex flex-wrap" style="margin-top: 15px;">
                    @endif
                @endforeach
            </div>

            <!-- Sizes Section -->
            <h2 style="font-size: 1.5rem; font-weight: 600; margin-top: 100px;">SIZES</h2>
            <div class="d-flex flex-wrap" style="margin-top: 15px;">
                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                    <div style="margin: 5px; flex: 0 0 25%;"> 
                        <div class="size-square" style="width: 55px; height: 40px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center;">
                            {{ $size }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Price Section -->
<h2 style="font-size: 1.5rem; font-weight: 600; margin-top: 100px;">PRICE</h2>
<div class="price-range" style="margin-top: 15px;">
    <input type="range" id="priceRange" min="1" max="3000" value="500" step="10" style="width: 100%;" oninput="updatePriceRange()">
    
    <!-- Min and Max Price Display -->
    <div class="d-flex justify-content-between" style="font-size: 0.8rem; color: #555; margin-top: 5px;">
        <span>Min Price ₹1</span>
        <span>Max Price ₹3000</span>
    </div>
</div>

        </div>  

        <!-- Right Section (Card and Product Section) -->
        <div class="col-md-9">
            <!-- Card Section -->
            <div class="card d-flex flex-row align-items-center mb-4" style="width: 100%; max-width: 1200px; height: 450px; background-color: #f8f9fa;">
                <!-- Text Section (Left Aligned with Equal Padding) -->
                <div class="d-flex flex-column justify-content-center" style="flex: 1; padding: 0 30px; text-align: left;">
                    <p style="font-size: 2.5rem; font-weight: 400; margin: 0;">WOMEN'S</p>
                    <p style="font-size: 3.0rem; font-weight: 800; margin: 0;">ACCESSORIES</p>
                    <p style="font-size: 1rem; font-weight: 400; margin: 0;">Accessories are the best way to update your look. Add a title edge with new styles and new colors, or go for timeless pieces.</p>
                </div>
                <!-- Image Section (Right) -->
                <div>
                    <img src="{{ asset('assets/images/shop_banner3.jpg') }}" alt="Women's Accessories" style="width: 400px; height: 450px; object-fit: cover;">
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card" style="border: none; position: relative; overflow: hidden; transition: transform 0.3s;">
                            <!-- Image Container -->
                            <div class="image-container" style="height: 380px; width: 100%; overflow: hidden; position: relative;">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">

                                <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <button type="submit" class="add-to-cart-button btn btn-primary">ADD TO CART</button>
                                </form>
                            
                            </div>

                            <!-- Product Details -->
                            <div class="product-details" style="padding-top: 10px;">
                                <!-- Category -->
                                @if($product->category)
                                    <div class="category-name" style="font-weight: normal; font-size: 1rem; text-align: left;">
                                        {{ $product->category->name }}
                                    </div>
                                @endif

                                <!-- Product Name -->
                                <div class="product-name" style="font-weight: normal; font-size: 1rem; text-align: left;">
                                    {{ $product->name }}
                                </div>

                                <!-- Price Section -->
                                <div class="price-section" style="font-size: 1rem; text-align: left;">
                                    <span style="text-decoration: line-through; color: #888;">
                                        ₹{{ number_format($product->regular_price, 2) }}
                                    </span>
                                    <span style="font-weight: bold; color: #000; margin-left: 8px;">
                                        ₹{{ number_format($product->sale_price, 2) }}
                                    </span>
                                </div>

                                <!-- Review Section -->
                                <div class="review-section" style="font-size: 0.9rem; color: #555; text-align: left;">
                                    ★★★★★ 8k+ reviews
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

<style>
/* Card Hover Effect */
.product-card {
        position: relative;
        transition: transform 0.3s ease;
    }
    .product-card:hover {
        transform: scale(1.05);
    }

    /* "Add to Cart" Button Styling */
    .add-to-cart-form {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        
        padding: 10px;
    }

    .product-card:hover .add-to-cart-form {
        opacity: 1;
    }

    /* Add to Cart Button Style */
    .add-to-cart-button {
        width: 100%;
        background-color: #fff;
        color: #333;
        border: none;
        font-size: 1rem;
        cursor: pointer;
        padding: 10px;
        font-weight: bold;
    }

    .add-to-cart-button:hover {
        background-color: #333;
        color: #fff;
    }
</style>

@endsection

@php
function uniqueColors() {
    return ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B8', '#E74C3C', '#3498DB', '#2ECC71', '#E67E22', '#1ABC9C'];
}
@endphp

<script>
    function updatePriceRange() {
        const priceRange = document.getElementById('priceRange');
        const displayValue = document.getElementById('displayValue');
        displayValue.textContent = priceRange.value; // Display the selected price value
    }

    document.querySelectorAll('.add-to-cart-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let form = this.closest('form');
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Update the cart count in the header
                document.getElementById('cart-count').textContent = data.cartCount;

                // Change the button text to "GO TO CART"
                this.textContent = "GO TO CART";

                // Make the button redirect to the cart page on the next click
                this.addEventListener('click', function() {
                    window.location.href = "{{ route('cart.show') }}";
                });
            })
            .catch(error => console.error('Error:', error));
        });
    });
    </script>
