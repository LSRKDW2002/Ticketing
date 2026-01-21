<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Buyer\EventController as BuyerEventController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role !== 'admin') {
        return redirect()->route('buyer.events.index');
    }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ================= ADMIN AREA =================
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Category Management
        Route::resource('categories', CategoryController::class);

        // Event Management
        Route::resource('events', EventController::class);

        // Tiket Management
        Route::resource('tickets', TiketController::class);

        // Payment Type Management (CRUD)
        Route::get('/payment-types', [PaymentTypeController::class, 'index'])->name('payment-types.index');
        Route::post('/payment-types', [PaymentTypeController::class, 'store'])->name('payment-types.store');
        Route::put('/payment-types/{id}', [PaymentTypeController::class, 'update'])->name('payment-types.update');
        Route::delete('/payment-types/{id}', [PaymentTypeController::class, 'destroy'])->name('payment-types.destroy');

        // Histories
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });

    // ================= BUYER AREA =================

    // Event list
    Route::get('/events', [BuyerEventController::class, 'index'])
        ->name('buyer.events.index');

    // Event detail
    Route::get('/events/{id}', [BuyerEventController::class, 'show'])
        ->name('buyer.events.show');

    // Checkout tiket
    Route::post('/checkout', [BuyerOrderController::class, 'store'])
        ->name('buyer.checkout');

    // Riwayat pembelian
    Route::get('/my-orders', [BuyerOrderController::class, 'history'])
        ->name('buyer.orders.history');

    Route::get('/my-orders/{id}', [BuyerOrderController::class, 'show'])
        ->name('buyer.orders.show');
});

require __DIR__ . '/auth.php';
