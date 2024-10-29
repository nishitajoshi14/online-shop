<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 80px;">
        </a>

        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left-aligned navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-3" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-3" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-3" href="#">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-3" href="#">About</a>
                </li>
            </ul>

            <!-- Right-aligned icons -->
            <ul class="navbar-nav ms-auto">
                <!-- Cart icon -->
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <!-- About icon -->
                <li class="nav-item">
                    <a class="nav-link mx-3" href="#">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </li>
                <!-- Login icon -->
                <li class="nav-item">
                    <a class="nav-link mx-3" href="{{route('login.post')}}">
                        <i class="fas fa-user"></i> <!-- Login icon -->
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
