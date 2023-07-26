<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\FaqController;
use App\Http\Controllers\Home\MapController;
use App\Http\Controllers\Home\PayController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\UnitController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Home\MessageController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Home\ReservationController;
use App\Http\Controllers\User\NotificationController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/unit/{unit:code}', [UnitController::class, 'show'])->name('unit.show');
Route::get('/searchresults', [MapController::class, 'FindUnitsBelongsToSearch'])->name('home.searchresults');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contact-us', [MessageController::class, 'index'])->name('message.index');
Route::post('/contact-us', [MessageController::class, 'store'])->name('message.store');
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');

Route::get('/owner/{user:id}/units',[UnitController::class, 'ownerUnits'])->name('owner.units');


Route::get('/pay', [PayController::class, 'store'])->name('pay.store');

Route::get('/payment/fail', function () {
    if (!URL::hasValidSignature(request())) {
        abort(401, 'This URL is not valid.');
    }
    return view('home.paymentFail');
})->name('home.paymentFail');

Route::get('/payment/success', function () {
    if (!URL::hasValidSignature(request())) {
        abort(401, 'This URL is not valid.');
    }
    return view('home.paymentSuccess');
})->name('home.paymentSuccess');


Route::get('/save-token', [HomeController::class, 'saveToken'])->name('save-token');

Route::post('/send-notification', [HomeController::class, 'sendNotification'])->name('send.notification');


Route::middleware('auth')->group(function () {
    Route::get('/user/reservations', [App\Http\Controllers\User\ReservationController::class, 'index'])->name('user.reservations');
    Route::get('/user/reservations/{booking:id}/details', [App\Http\Controllers\User\ReservationController::class, 'reservationDetails'])->name('user.reservations.details');
    Route::get('/user/wishlist', [WishlistController::class, 'index'])->name('user.wishlist');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/review', [ReviewController::class, 'submitRate'])->name('review.submit');
    Route::get('/markAsRead',[NotificationController::class,'markAsRead'])->name('markAsRead');
});
