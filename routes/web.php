<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DashboardLoginController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Storefront\CheckoutController;
use App\Http\Controllers\Storefront\ContactController;
use App\Http\Controllers\Storefront\ProductController as StorefrontProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/products', [StorefrontProductController::class, 'index'])->name('products');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/address', [CheckoutController::class, 'store'])->name('checkout.address.store');
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/about-us', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard/login', [DashboardLoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/dashboard/login', [DashboardLoginController::class, 'store'])->middleware(['guest', 'throttle:dashboard-login'])->name('dashboard.login.store');

Route::middleware('auth')->group(function () {
    Route::post('/dashboard/logout', [DashboardLoginController::class, 'destroy'])->name('dashboard.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/enquiries', [EnquiryController::class, 'index'])->name('dashboard.enquiries');
    Route::patch('/dashboard/enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('dashboard.enquiries.update');
    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');
    Route::patch('/dashboard/orders/{order}', [OrderController::class, 'update'])->name('dashboard.orders.update');
    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('dashboard.products');
    Route::get('/dashboard/products/show', [ProductController::class, 'create'])->name('dashboard.products.show');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
    });
});
