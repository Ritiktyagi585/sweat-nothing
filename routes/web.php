<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/products', function () {
    return view('frontend.products');
})->name('products');

Route::get('/about-us', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard/enquiries', function () {
    return view('enquries.index');
})->name('dashboard.enquiries');

Route::get('/dashboard/orders', function () {
    return view('orders.index');
})->name('dashboard.orders');

Route::get('/dashboard/products', function () {
    return view('product.index');
})->name('dashboard.products');
