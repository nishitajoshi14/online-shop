<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Online Shopping')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles') <!-- Include additional styles -->
</head>
<body>

    @include('header')

    <div class="container mt-5">
        @yield('content')
    </div>

    <div class="footer-container">
        <!-- Logo and information section -->
        <div class="footer-logo-info">
            <div class="footer-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo">
            </div>
            <div class="footer-info">
                <p>123 Beach Avenue Surfside City, 00000</p>
                <p>contact@onlineshopmedia.in</p>
                <p>+1 000-000-0000</p>
            </div>
        </div>
        <div class="footer-links">
            <!-- COMPANY section -->
            <div class="section">
                <span>COMPANY</span>
                <div class="section-links">
                    <p>About Us</p>
                    <p>Careers</p>
                    <p>Affiliates</p>
                    <p>Blog</p>
                    <p>Contact Us</p>
                </div>
            </div>
            <!-- SHOP section -->
            <div class="section">
                <span>SHOP</span>
                <div class="section-links">
                    <p>New Arrivals</p>
                    <p>Accessories</p>
                    <p>Men</p>
                    <p>Women</p>
                    <p>Shop All</p>
                </div>
            </div>
            <!-- HELP section -->
            <div class="section">
                <span>HELP</span>
                <div class="section-links">
                    <p>Service</p>
                    <p>My Account</p>
                    <p>Find Store</p>
                    <p>Privacy</p>
                    <p>Gift Card</p>
                </div>
            </div>
            <!-- CATEGORIES section -->
            <div class="section">
                <span>CATEGORIES</span>
                <div class="section-links">
                    <p>Shirts</p>
                    <p>Jeans</p>
                    <p>Shoes</p>
                    <p>Bags</p>
                    <p>Shop All</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
