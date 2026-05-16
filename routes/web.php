<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\MessageController as UserMessageController;

// # Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// # Halaman About Us (publik, tanpa login)
Route::get('/about', [HomeController::class, 'about'])->name('about');

// # Auth Routes
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');

// # Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('books', AdminBookController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
    Route::post('/shipping/{order}', [ShippingController::class, 'store'])->name('shipping.store');
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
});

// # User Routes
Route::middleware('user.role')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
    Route::get('/books/{book}', [UserBookController::class, 'show'])->name('user.books.show');
    Route::get('/contact', [UserMessageController::class, 'show'])->name('user.contact');
    Route::post('/contact', [UserMessageController::class, 'store'])->name('user.contact.store');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('/cart', [CartController::class, 'store'])->name('user.cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('user.cart.destroy');
    Route::get('/checkout', [UserOrderController::class, 'checkout'])->name('user.checkout');
    Route::post('/checkout', [UserOrderController::class, 'store'])->name('user.checkout.store');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
});
