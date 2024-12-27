<header class="d-flex flex-wrap align-items-center justify-content-between my-4 p-3" style="background-color: #f7f0f0; color: #000;">
    <!-- Search Bar Section -->
    <div class="search-bar flex-grow-1 d-flex justify-content-center justify-content-md-start">
        <form class="form-inline w-100 w-md-auto">
            <div class="input-group" style="width: 100%; max-width: 500px; border: 1.5px solid rgb(173, 171, 171); border-radius: 4px;">
                <!-- Search Bar with Black Border -->
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" style="background-color: #faf6f6; border: none;">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" style="background-color: #f7f2f2; border: none;">
                        <i class="fas fa-search"></i> <!-- Search Icon -->
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Navigation Links Section -->
    <nav class="ml-auto">
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('home') }}" style="color: #000;">Home</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('shop.index') }}" style="color: #000;">Shop</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('about') }}" style="color: #000;">About</a>
            </li>
        </ul>
    </nav>
</header>
