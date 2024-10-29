<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <!-- Logo Section -->
        <div class="text-center py-3">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100px;"> 
        </div>

        <!-- Sidebar Menu -->
        <h5 class="sidebar-heading">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </h5>
        
        <ul class="nav flex-column">
            <!-- Products Menu with Arrow -->
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="javascript:void(0);" id="products-toggle">
                    <i class="fas fa-box mr-2"></i> Products
                    <i class="fas fa-chevron-up float-right" id="products-arrow" style="font-size: 10px;"></i>
                </a>
                <ul class="nav flex-column ml-3" id="products-submenu" style="display: none;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.products.create')}}">
                            <i class="fas fa-plus mr-2"></i> Add Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.products.index')}}">
                            <i class="fas fa-box-open mr-2"></i> Products
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Brand Menu with Arrow -->
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="javascript:void(0);" id="brand-toggle">
                    <i class="fas fa-tag mr-2"></i> Brand
                    <i class="fas fa-chevron-up float-right" id="brand-arrow" style="font-size: 10px;"></i>
                </a>
                <ul class="nav flex-column ml-3" id="brand-submenu" style="display: none;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('brands.create')}}">
                            <i class="fas fa-plus mr-2"></i> New Brand
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('brands.index')}}">
                            <i class="fas fa-tags mr-2"></i> Brands
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Category Menu with Arrow -->
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="javascript:void(0);" id="category-toggle">
                    <i class="fas fa-th-large mr-2"></i> Category
                    <i class="fas fa-chevron-up float-right" id="category-arrow" style="font-size: 10px;"></i>
                </a>
                <ul class="nav flex-column ml-3" id="category-submenu" style="display: none;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.create')}}">
                            <i class="fas fa-plus mr-2"></i> New Category
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.index')}}">
                            <i class="fas fa-th-list mr-2"></i> Categories
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Orders Menu with Arrow -->
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="javascript:void(0);" id="order-toggle">
                    <i class="fas fa-shopping-cart mr-2"></i> Orders
                    <i class="fas fa-chevron-up float-right" id="order-arrow" style="font-size: 10px;"></i>
                </a>
                <ul class="nav flex-column ml-3" id="order-submenu" style="display: none;">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-box mr-2"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-truck mr-2"></i> Order Tracking
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf <!-- Include CSRF token for security -->
                    <button type="submit" class="nav-link sidebar-link" style="border: none; background: none; padding: 0;">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- JavaScript for toggling the submenus and collapsing others -->
<script>
    function toggleMenu(menuId, arrowId) {
        const menu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);

        // Hide all other submenus
        const submenus = document.querySelectorAll('.nav.flex-column.ml-3');
        const arrows = document.querySelectorAll('.fas.fa-chevron-up, .fas.fa-chevron-down');

        submenus.forEach((submenu) => {
            if (submenu !== menu) {
                submenu.style.display = 'none';
            }
        });

        arrows.forEach((arr) => {
            if (arr !== arrow) {
                arr.classList.remove('fa-chevron-down');
                arr.classList.add('fa-chevron-up');
            }
        });

        // Toggle current submenu
        menu.style.display = (menu.style.display === 'none') ? 'block' : 'none';
        arrow.classList.toggle('fa-chevron-up');
        arrow.classList.toggle('fa-chevron-down');
    }

    // Add event listeners for all menus
    document.getElementById('products-toggle').addEventListener('click', function() {
        toggleMenu('products-submenu', 'products-arrow');
    });

    document.getElementById('brand-toggle').addEventListener('click', function() {
        toggleMenu('brand-submenu', 'brand-arrow');
    });

    document.getElementById('category-toggle').addEventListener('click', function() {
        toggleMenu('category-submenu', 'category-arrow');
    });

    document.getElementById('order-toggle').addEventListener('click', function() {
        toggleMenu('order-submenu', 'order-arrow');
    });
</script>
