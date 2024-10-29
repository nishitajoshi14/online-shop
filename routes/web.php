<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;



// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');



// Show login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login logic
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// Add this route to your web.php file
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Show the registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration logic
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');


//Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
   // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/add-category', [CategoryController::class, 'create'])->name('category.create');
//Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');






// Category Routes
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/admin/store-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/admin/update-category/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin/delete-category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/admin/categories/search', [CategoryController::class, 'search'])->name('categories.search');




Route::prefix('admin')->group(function() {
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/update/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/delete/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
});








Route::prefix('admin')->group(function () {
    Route::get('/add-product', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');

    // Route for editing a product
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

    // Route for updating a product
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');

    // Route for deleting a product
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
