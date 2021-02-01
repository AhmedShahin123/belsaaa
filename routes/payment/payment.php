<?php

use App\Http\Controllers\Payment\CardController;
use App\Http\Controllers\Payment\PaymentCallbackController;

Route::get('/callback', [PaymentCallbackController::class, '__invoke'])->name('callback');
Route::get('/credit_card', [CardController::class, 'initialize'])->name('credit_card.initialize')->middleware(['payment.secured']);
Route::post('/credit_card', [CardController::class, 'create'])->name('credit_card.create')->middleware(['payment.secured']);
