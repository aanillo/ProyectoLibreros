<?php

use App\Http\Controllers\PurchaseController;

Route::get('/purchase-checkout/{book_id}', [PurchaseController::class, 'create'])->name('purchaseCheckout');
Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchase/success/{purchase}', [PurchaseController::class, 'paymentSuccess'])->name('purchase.success');
Route::get('/purchase/failure/{purchase}', [PurchaseController::class, 'paymentFailure'])->name('purchase.failure');
Route::get('/paypal/checkout/{purchase}', [PurchaseController::class, 'processPayPalPayment']);
Route::get('/purchase-checkout', [PurchaseController::class, 'checkout'])->name('purchaseCheckoutAll');
