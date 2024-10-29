@extends('layouts.app')

@section('title', 'Online Shopping')

@section('content')
<div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <h2 class="content-title">Night Spring Dresses</h2>
    </div>

    <div class="col-md-6">
        <div id="slideshow">
            <img src="{{ asset('assets/images/Dress.jpeg') }}" class="active" alt="Dress 1">
            <img src="{{ asset('assets/images/Dress2.png') }}" alt="Dress 2">
            <img src="{{ asset('assets/images/Dress3.png') }}" alt="Dress 3">
        </div>
    </div>
</div>

<!-- Title for Swiper Slider (Centered) -->
<h3 class="swiper-title">More Fashionable Options</h3>

<!-- Horizontal Swiper Slider -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="{{ asset('assets/images/WomenTops.png') }}" alt="Dress 1"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/WomenPants.png') }}" alt="Dress 2"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/MenJeans.png') }}" alt="Dress 3"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/MenShirts.png') }}" alt="Dress 4"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/MenShoes.png') }}" alt="Dress 5"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/WomenClothes.png') }}" alt="Dress 6"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/WomenDresses.png') }}" alt="Dress 7"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/KidsTops.png') }}" alt="Dress 8"></div>
    </div>

    <div class="custom-arrow arrow-left"><</div>
    <div class="custom-arrow arrow-right">></div>
    <div class="swiper-pagination"></div>
</div>

<h3 class="hot-deals-title">Hot Deals</h3>

<div class="row">
    <div class="col-md-3 d-flex flex-column justify-content-center">
        <h2 class="sale-title">Summer Sale</h2>
        <p class="sale-subtitle">Up to 60% off</p>
    </div>

    <div class="col-md-9">
        <div class="horizontal-boxes">
            @foreach (['box1', 'box2', 'box3', 'box4'] as $box)
                <div class="box" style="position: relative;">
                    <div class="box-slideshow">
                        <img src="{{ asset("assets/images/{$box}.jpg") }}" class="active" alt="Box Image">
                        <img src="{{ asset("assets/images/{$box}-2.jpg") }}" alt="Box Image">
                    </div>
                    <div class="box-title">Product Name</div>
                    <div class="add-to-cart-btn">Add to Cart</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row" style="margin-top: 50px;">
    <div class="col-md-6">
        <div class="big-box" style="position: relative;">
            <img src="{{ asset('assets/images/category_9.jpg') }}" alt="Big Box 1">
            <div class="small-circle">
                <span>STARTING AT ₹500</span>
            </div>
            <div class="big-box-title">Blazers</div>
            <div class="add-to-cart-btn">Add to Cart</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="big-box" style="position: relative;">
            <img src="{{ asset('assets/images/category_10.jpg') }}" alt="Big Box 2">
            <div class="small-circle">
                <span>STARTING AT ₹500</span>
            </div>
            <div class="big-box-title">Sportswear</div>
            <div class="add-to-cart-btn">Add to Cart</div>
        </div>
    </div>
</div>

<div class="title-container">
    <h2 class="featured-title">Featured Products</h2>
</div>

<div class="centered-container">
    @foreach (range(4, 11) as $i)
        <div class="product-item">
            <div class="distinct-box">
                <img src="{{ asset("assets/images/product-{$i}.jpg") }}" alt="Item {{ $i }}">
            </div>
            <h3 class="product-name">Product {{ $i }}</h3>
            <p class="product-price">₹{{ rand(499, 1000) }}</p>
        </div>
    @endforeach
</div>

<h1 class="more">LOAD MORE</h1>
@endsection
