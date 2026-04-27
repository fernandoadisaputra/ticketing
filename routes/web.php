<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/news', [FrontendController::class, 'news'])->name('news');
Route::get('/news/{news}', [FrontendController::class, 'showNews'])->name('news.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer Routes
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('customer.dashboard');
    })->name('dashboard');

    Route::get('/order', [FrontendController::class, 'orderForm'])->name('customer.order');
    Route::post('/order', [FrontendController::class, 'processOrder'])->name('customer.order.process');
    Route::get('/payment/{order}', [FrontendController::class, 'payment'])->name('customer.payment');
    Route::get('/payment-success/{order}', [FrontendController::class, 'paymentSuccess'])->name('customer.payment.success');
    Route::get('/eticket/{order}', [FrontendController::class, 'eticket'])->name('customer.eticket');
    Route::get('/my-tickets', [FrontendController::class, 'myTickets'])->name('customer.my_tickets');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('news', NewsController::class);
    Route::resource('tickets', TicketTypeController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::post('/midtrans-callback', [FrontendController::class, 'callback']);

require __DIR__.'/auth.php';
