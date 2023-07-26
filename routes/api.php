<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PayController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\UnitController;
use App\Http\Controllers\API\FilterController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DistrictController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\NotificationController;
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

Route::group(['middleware' => ['SecretKey', 'CheckLang']], function () {

    // login and register 
    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/update/profile', [AuthController::class, 'updateProfile']);
    Route::post('/auth/update/password', [AuthController::class, 'updatePassword']);
    Route::post('/auth/forget_password', [AuthController::class, 'forgetPassword']);
    Route::post('/auth/login', [AuthController::class, 'loginUser']);

    // cities api routes
    Route::get('city', [CityController::class, 'AllCities'])->name('city');
    Route::get('city/units', [CityController::class, 'CityHasUnits']);
    Route::get('city/featured', [CityController::class, 'featuredCities']);
    Route::get('city/{city:slug}', [CityController::class, 'ShowCity']);
    Route::get('city/{city:slug}/districts', [CityController::class, 'Showdistricts']);

    // category
    Route::get('category', [CategoryController::class, 'AllCategories']);
    Route::get('category/{category:slug}', [CategoryController::class, 'ShowUnitsRelated']);

    // District
    Route::get('district/{district:slug}', [DistrictController::class, 'ShowUnitsRelated']);
    Route::get('districts', [DistrictController::class, 'AllDistricts'])->name('districts');

    // search
    Route::post('search', [SearchController::class, 'searchForCityWithDate']);

    // featured
    Route::get('units/featured', [UnitController::class, 'FeaturedUnits']);
    Route::get('units/belongs_to/city', [UnitController::class, 'GetUnitsBelongsToCityName']);
    // get units via lat and long to the nearst radius like 5km to 1000km 
    Route::post('/units/by-coordinates', [UnitController::class, 'findUnitsByCoordinates']);

    // filters
    Route::get('filters', [FilterController::class, 'filters']);

    // booking
    Route::get('/units/{code}/booked-dates', [UnitController::class, 'getBookedUnitDates']);

    // fcm token
    Route::post('/fcm_token', [AuthController::class, 'getFcmToken']);

    // middleware for checking user token 
    Route::group(['middleware' => ['sanctum']], function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/profile', [AuthController::class, 'userProfile']);
        Route::post('/units/{code}/booking', [BookingController::class, 'booking']);
        Route::post('/units/{code}/availability', [PayController::class, 'availability']);
        Route::post('/units/{code}/pay', [PayController::class, 'store']);
        Route::post('/booking/history', [BookingController::class, 'history']);
        Route::get('/wishlist', [WishlistController::class, 'belongsToUser']);
        Route::post('/wishlist/add', [WishlistController::class, 'addUnit']);
        Route::post('/wishlist/remove', [WishlistController::class, 'removeUnit']);
        Route::get('/notifications', [NotificationController::class, 'belongsToUser'])->name('notifications.all');
        Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
        Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');

    });
});


require __DIR__ . '/ownerAPI.php';
