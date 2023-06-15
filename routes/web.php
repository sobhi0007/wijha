<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ToiletController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CapacityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Owner\OwnerHomeController;
use App\Http\Controllers\Owner\OwnerUnitController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\Owner\OwnerReviewController;
use App\Http\Controllers\Owner\OwnerBookingController;
use App\Http\Controllers\Owner\OwnerPaymentController;
use App\Http\Controllers\Owner\OwnerProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/gmap',function(){
    return view('gmap');
    
});

// Route::get('/reservations', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('reservations', ReservationController::class)->names('reservations');

});

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['admin'])->group(function () {

        ##------------------------------------------------------- ADMIN INDEX PAGE
        Route::get('/', AdminHomeController::class)->name('index');

        ##------------------------------------------------------- REPORTS MODULE
        Route::controller(ReportController::class)->group(function () {
            Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
            Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
        });

        ##------------------------------------------------------- PAYMENTS MODULE
        Route::controller(PaymentController::class)->group(function () {
            Route::resource('payments', PaymentController::class)->except(['create', 'store', 'edit', 'update']);
        });

        ##------------------------------------------------------- REVIEWS MODULE
        Route::controller(ReviewController::class)->group(function () {
            Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
        });

        ##------------------------------------------------------- BOOKINGS MODULE
        Route::controller(BookingController::class)->group(function () {
            Route::resource('bookings', BookingController::class);
        });


        ##------------------------------------------------------- UNITS MODULE
        Route::controller(UnitController::class)->group(function () {
            Route::resource('units', UnitController::class);
        });

        ##------------------------------------------------------- TOILETS MODULE
        Route::controller(ToiletController::class)->group(function () {
            Route::resource('toilets', ToiletController::class)->except('show');
        });

        ##------------------------------------------------------- KITCHENS MODULE
        Route::controller(KitchenController::class)->group(function () {
            Route::resource('kitchens', KitchenController::class)->except('show');
        });

        ##------------------------------------------------------- BADGES MODULE
        Route::controller(BadgeController::class)->group(function () {
            Route::resource('badges', BadgeController::class)->except('show');
        });

        ##------------------------------------------------------- VIEWS MODULE
        Route::controller(ViewController::class)->group(function () {
            Route::resource('views', ViewController::class)->except('show');
        });

        ##------------------------------------------------------- POOLS MODULE
        Route::controller(PoolController::class)->group(function () {
            Route::resource('pools', PoolController::class)->except('show');
        });

        ##------------------------------------------------------- PERSONS MODULE
        Route::controller(PersonController::class)->group(function () {
            Route::resource('persons', PersonController::class)->except('show');
        });

        ##------------------------------------------------------- CAPACITIES MODULE
        Route::controller(CapacityController::class)->group(function () {
            Route::resource('capacities', CapacityController::class)->except('show');
        });

        ##------------------------------------------------------- TYPES MODULE
        Route::controller(TypeController::class)->group(function () {
            Route::resource('types', TypeController::class)->except('show');
        });

        ##------------------------------------------------------- CATEGORIES MODULE
        Route::controller(CategoryController::class)->group(function () {
            Route::resource('categories', CategoryController::class);
        });

        ##------------------------------------------------------- DISTRICTS MODULE
        Route::controller(DistrictController::class)->group(function () {
            Route::post('/getDistrictsByCity', [DistrictController::class, 'getByCity'])->name('districts.getByCity');
            Route::resource('districts', DistrictController::class)->except('show');
        });

        ##------------------------------------------------------- CITIES MODULE
        Route::controller(CityController::class)->group(function () {
            Route::resource('cities', CityController::class);
        });

        ##------------------------------------------------------- FAQS MODULE
        Route::controller(FaqController::class)->group(function () {
            Route::resource('faqs', FaqController::class);
        });

        ##------------------------------------------------------- MESSAGES MODULE
        Route::controller(MessageController::class)->group(function () {
            Route::resource('messages', MessageController::class)->only(['index', 'delete', 'show', 'destroy']);
        });

        ##------------------------------------------------------- SLIDERS MODULE
        Route::controller(SliderController::class)->group(function () {
            Route::resource('sliders', SliderController::class);
        });

        ##------------------------------------------------------- USERS MODULE
        Route::controller(UserController::class)->group(function () {
            Route::resource('users', UserController::class);
        });

        ##------------------------------------------------------- ROLES MODULE
        Route::controller(RoleController::class)->group(function () {
            Route::resource('roles', RoleController::class);
        });

        ##------------------------------------------------------- ADMINS MODULE
        Route::controller(AdminController::class)->group(function () {
            Route::resource('admins', AdminController::class);
        });

        ##------------------------------------------------------- SETTINGS MODULE
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings/{view}', 'basic')->name('settings.basic');
            Route::resource('settings', SettingController::class)->only('update');
        });

        ##------------------------------------------------------- ADMIN PROFILE SECTION
        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
            Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile');
            Route::post('/password', [AdminProfileController::class, 'updatePassword'])->name('changePassword');
        });
    });

    require __DIR__ . '/adminAuth.php';
});



require __DIR__ . '/home.php';



/*
|--------------------------------------------------------------------------
| Owner Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('owner')->name('owner.')->group(function () {

    Route::middleware(['owner'])->group(function () {

        ##------------------------------------------------------- HOME PAGE
        Route::get('/', OwnerHomeController::class)->name('index');

        ##------------------------------------------------------- BOOKINGS MODULE
        Route::controller(OwnerBookingController::class)->group(function () {
            Route::resource('bookings', OwnerBookingController::class)->only(['index', 'show']);
        });

        ##------------------------------------------------------- UNITS MODULE
        Route::controller(OwnerUnitController::class)->group(function () {
            Route::resource('units', OwnerUnitController::class)->except('destroy');
        });

        ##------------------------------------------------------- PAYMENTS MODULE
        Route::controller(OwnerPaymentController::class)->group(function () {
            Route::resource('payments', OwnerPaymentController::class)->only(['index', 'show']);
        });

        ##------------------------------------------------------- REVIEWS MODULE
        Route::controller(OwnerReviewController::class)->group(function () {
            Route::resource('reviews', OwnerReviewController::class)->only(['index', 'show']);
        });

        ##------------------------------------------------------- ADMIN PROFILE SECTION
        Route::controller(OwnerProfileController::class)->group(function () {
            Route::get('/profile', [OwnerProfileController::class, 'index'])->name('profile');
            Route::post('/profile', [OwnerProfileController::class, 'update'])->name('profile');
            Route::post('/password', [OwnerProfileController::class, 'updatePassword'])->name('changePassword');
        });
    });

    require __DIR__ . '/ownerAuth.php';
});
