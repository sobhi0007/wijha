<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerApi\AuthController;
use App\Http\Controllers\OwnerApi\UnitController;
use App\Http\Controllers\OwnerApi\ReviewController;
use App\Http\Controllers\OwnerApi\BookingController;
use App\Http\Controllers\OwnerApi\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('owner')->middleware(['OwnerApiLocalization', 'OwnerApiSecretKey'])->group(function () {

    ##------------------------------------------------------- AUTH
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        ##------------------------------------------------------- BOOKING
        Route::get('/bookings', [BookingController::class, 'bookings']);
        Route::get('/bookings/{reference_number}', [BookingController::class, 'show']);
        Route::get('/bookingsStatuses', [BookingController::class, 'bookingsStatuses']);

        ##------------------------------------------------------- REVIEWS
        Route::get('/reviews', [ReviewController::class, 'reviews']);
        Route::get('/reviews/{id}', [ReviewController::class, 'show']);

        ##------------------------------------------------------- PAYMENTS
        Route::get('/payments', [PaymentController::class, 'payments']);
        Route::get('/payments/{id}', [PaymentController::class, 'show']);

        ##------------------------------------------------------- UNITS
        Route::get('/units', [UnitController::class, 'units']);
        Route::get('/units/{code}', [UnitController::class, 'show']);
        Route::get('/unit/create/info', [UnitController::class, 'createInfo']);
        Route::post('/unit/store', [UnitController::class, 'store']);
        Route::post('/unit/{unit:code}', [UnitController::class, 'update']);
    });
});
