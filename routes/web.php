<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

Route::prefix('auth')->group(function () {
    // Guest only routes (not logged in)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
        Route::post('/login', [UserAuthController::class, 'login']);
        Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
        Route::post('/register', [UserAuthController::class, 'register']);
    });

    // Authenticated user routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
        
        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/profile', [ProfileController::class, 'store'])->name('user.profile.store');
        Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    
        // Orders
        Route::get('/my-orders', [OrderController::class, 'index'])->name('user.orders');
        Route::get('/orders/payment-confirmation', [OrderController::class, 'paymentConfirmation'])->name('user.orders.payment');
        Route::get('/orders/status', [OrderController::class, 'orderStatus'])->name('user.orders.status');
        
        // Bookings - User reservations (FIXED: menggunakan {id} bukan {bookingid})
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('user.bookings');
        Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('booking.show');
        Route::delete('/bookings/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
    });
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('service');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Booking routes
Route::get('/booking', [BookingController::class, 'index'])->name('booking');

// Protected booking routes - require authentication
Route::middleware('auth')->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
});

// Product and Cart routes
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    Route::get('/shipping', [ShippingController::class, 'form'])->name('shipping.form');
    Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
    
    Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/payment/store', [PaymentController::class, 'storeProof'])->name('payment.store');
    Route::get('/payment/confirmation', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');
});

//admin
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminOrderController;

Route::prefix('admin')->group(function () {
    
    // Routes yang tidak memerlukan middleware admin
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Group routes yang memerlukan middleware admin
    Route::middleware(['admin'])->group(function () {
        // Halaman Dashboard Admin (setelah login)
        Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');

        // Booking Page (FIXED: menggunakan {id} bukan {bookingid})
        Route::get('/booking', [AdminBookingController::class, 'index'])->name('admin.booking');
        Route::post('/booking/update-status/{id}', [AdminBookingController::class, 'updateStatus'])->name('admin.booking.updateStatus');
        
        // CRUD Product
        Route::get('/product', [AdminProductController::class, 'index'])->name('admin.product');
        Route::get('/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
        Route::post('/product/store', [AdminProductController::class, 'store'])->name('admin.product.store');
        Route::get('/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/product/update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::post('/product/bulk-destroy', [AdminProductController::class, 'bulkDestroy'])->name('admin.product.bulkDestroy');
        Route::get('/product/show/{id}', [AdminProductController::class, 'show'])->name('admin.product.show');
        Route::patch('/product/update-stock/{id}', [AdminProductController::class, 'updateStock'])->name('admin.product.updateStock');

        // Payment Page
        Route::get('/payment', [AdminPaymentController::class, 'index'])->name('admin.payment');
        Route::post('/payment/update/{id}', [AdminPaymentController::class, 'updateStatus'])->name('admin.payment.update');

        // Order Page
        Route::get('/order', [AdminOrderController::class, 'index'])->name('admin.order');
        Route::put('/order/update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.order.updateStatus');
    });
});