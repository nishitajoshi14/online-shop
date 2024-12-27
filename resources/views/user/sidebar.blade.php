<!-- resources/views/user/sidebar.blade.php -->
<nav id="sidebar" class="bg-light p-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('user.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <!-- resources/views/user/sidebar.blade.php -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.profile') }}">
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

        <!-- New Coupons Option -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.coupons')}}">
                <i class="fas fa-tag"></i> Coupons
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.settings')}}">
                <i class="fas fa-cog"></i> Settings
            </a>
        </li>
        
        
    </ul>
</nav>
