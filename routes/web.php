<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PreviousProductController;
use App\Http\Controllers\PaymentController;








// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::put('/cart/{index}', [CartController::class, 'update'])->name('cart.update'); // Route for updating quantity
Route::delete('/cart/{index}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::post('/cart/validate-coupon', [CartController::class, 'validateCoupon'])->name('cart.validateCoupon');
Route::post('/coupon/verify', [CouponController::class, 'verify'])->name('coupon.verify');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/admin/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.updateOrderStatus');

// In routes/web.php
//Route::get('/order-details', [CartController::class, 'showOrderDetails'])->name('cart.show');

//Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('orders.show');


// routes/web.php
Route::get('/about', [PageController::class, 'about'])->name('about');







//Route::get('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');


//Route::get('payment/{orderId}', [PaymentController::class, 'index'])->name('payment.index');

//Route::post('payment/{orderId}/process', [PaymentController::class, 'process'])->name('payment.process');


//Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

// Payment Routes
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::post('/checkout/payment', [CheckoutController::class, 'stripePayment'])->name('checkout.payment');
Route::post('/payment/payNow', [PaymentController::class, 'payNow'])->name('payment.payNow');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');


// Show the registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration logic
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify.email');
Route::get('/otp-verification', [RegisterController::class, 'showOtpForm'])->name('otp.form');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('otp.verify');
Route::patch('/users/{id}/toggle-status', [UsersController::class, 'toggleStatus'])->name('users.toggleStatus');




Route::get('/user/dashboard', function() {
    return view('user.dashboard'); // Make sure you create this file
})->name('user.dashboard');


Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
Route::get('/orders/{id}', [UserController::class, 'viewOrder'])->name('user.viewOrder');

Route::get('/user/accountdetails', [UserController::class, 'accountDetails'])->name('user.accountdetails');
Route::get('/user/coupons', [UserController::class, 'showCoupons'])->name('user.coupons');

Route::post('/apply-coupon', [UserController::class, 'applyCoupon'])->name('apply.coupon');
Route::get('/coupons', [UserController::class, 'showCoupons'])->name('coupons');


Route::put('/user/update-account/{id}', [UserController::class, 'updateAccount'])->name('user.updateAccount');


Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
Route::post('/user/order/cancel/{id}', [UserController::class, 'cancelOrder'])->name('user.order.cancel');

Route::post('/add-to-previous-products', [PreviousProductController::class, 'addToPreviousProducts'])->name('add.to.previous.products');
Route::get('/previous-products', [PreviousProductController::class, 'viewPreviousProducts'])->name('user.previousProducts');



Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
//Route::get('/logout', [UserController::class, 'logout'])->name('logout');




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


Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/admin/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');



Route::prefix('admin')->group(function () {
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    
});


