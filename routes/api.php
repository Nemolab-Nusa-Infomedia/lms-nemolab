<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseApiController;
use App\Http\Controllers\Member\MemberPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Mengelompokkan route dengan middleware 'maintenance.middleware'
// Middleware ini akan memeriksa apakah sistem dalam mode pemeliharaan
Route::middleware('maintenance.middleware')->group(function () {
    // Ketika ada permintaan POST 'checkout' pada MemberPaymentController akan dijalankan
    Route::post('/webhook/transaction', [MemberPaymentController::class, 'checkout'])->name('member.webhook.transaction');
});
