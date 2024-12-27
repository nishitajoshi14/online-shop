<!-- resources/views/header.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 80px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
            </ul>

            <ul class="navbar-nav d-flex justify-content-end">
                <li class="nav-item">
                    <a class="nav-link mx-3" href="{{ route('cart.show') }}" id="cart-link" style="position: relative;">
                        <i class="fas fa-shopping-bag fa-lg custom-icon"></i>
                        @php
                            $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
                        @endphp
                        @if(Session::has('user') && $cartCount > 0)
                            <span id="cart-count" class="custom-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>

                <!-- Check if user is logged in -->
                @if(Session::has('user'))
                    <div class="header">
                        
                        
                        <!-- Admin Dashboard -->
                        @if(Session::get('username') === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link btn btn-primary my-account-button">My Account</a>
                            </li>
                        @else
                            <!-- User Profile -->
                            <li class="nav-item">
                                <a href="{{ route('user.accountdetails') }}" class="nav-link btn btn-primary my-account-button">My Account</a>
                            </li>
                        @endif

                        <!-- Logout -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    </div>
                @else
                    <!-- Login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.form') }}">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Custom Styling -->
<style>
    .my-account-button {
        color: rgb(147, 170, 250) !important; /* Set the text color to white */
        background-color: transparent !important; /* Optional: Make background transparent */
        border: none; /* Remove border */
        padding: 0.5rem 1rem; /* Adjust padding for better spacing */
        text-decoration: none; /* Remove underline */
    }

    .my-account-button:hover {
        color: #ee3535 !important; /* Change text color on hover for better contrast */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartLink = document.getElementById('cart-link');
        
        // If user is not logged in, show an alert when clicking the cart
        @if(!Session::has('user'))
            cartLink.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default action (redirect)
                alert('Please log in to access your cart.');
            });
        @endif
    });
</script>
