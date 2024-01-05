<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::post('/sessions', [SessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('invoices', InvoiceController::class);
    
    Route::delete('/sessions', [SessionController::class, 'destroy']);
});