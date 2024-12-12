<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Manage\ManageController;
use App\Http\Controllers\Web\PaymentPixController;
use App\Http\Controllers\Web\Tickets\MyTicketsController;
use App\Http\Controllers\Web\Tickets\TicketsController;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MyTicketsController::class, 'viewMyTickets'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/payment-pix', [PaymentPixController::class, 'showPaymentPix'])->name('payment-pix');

    Route::get('/buyticket', [TicketsController::class, 'viewBuyTicket'])->middleware(['auth', 'verified'])->name('buyticket');
    Route::post('/purchases', [TicketsController::class, 'buyTicket'])->middleware(['auth', 'verified'])->name('post.buyticket');


    Route::get('/manage', [ManageController::class, 'index'])->name('manage');
});

require __DIR__.'/auth.php';
