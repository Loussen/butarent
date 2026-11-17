<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\clientCarController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\addNewAdminController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\carSearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteContentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminProfileController;
use App\Models\User;
use App\Models\Car;
use App\Models\Reservation;


// ------------------- guest routes --------------------------------------- //
Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['az', 'en', 'ru'], true), 404);
    session(['locale' => $locale]);

    return redirect()->back();
})->name('locale.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', function () {
    $cars = Car::with(['images', 'brandRelation', 'carModel'])->take(6)->where('status', '=', 'available')->get();
    return view('home', compact('cars'));
})->name('home');

Route::get('/cars', [clientCarController::class, 'index'])->name('cars');
Route::get('/cars/search', [carSearchController::class, 'search'])->name('carSearch');
Route::get('/rent-a-car/{car}', [clientCarController::class, 'show'])->name('car.details');
Route::get('/cars/{car}', function (Car $car) {
    return redirect()->to(route('car.details', $car), 301);
});

Route::get('location', function () {
    return view('location');
})->name('location');

Route::get('contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::get('/buta_manager', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/buta_manager', [LoginController::class, 'login'])->name('admin.login.submit');

// Security: never expose or redirect /admin*
Route::any('/admin/{path?}', function () {
    abort(404);
})->where('path', '.*');

Route::get('/privacy_policy', [PageController::class, 'showPublic'])
    ->defaults('slug', 'privacy_policy')
    ->name('privacy_policy');

Route::get('/terms_conditions', [PageController::class, 'showPublic'])
    ->defaults('slug', 'terms_conditions')
    ->name('terms_conditions');


// -------------------------------------------------------------------------//




// ------------------- admin routes (hidden path) --------------------------- //

Route::prefix('buta_manager')->middleware('admin')->group(function () {

    Route::get(
        '/dashboard',
        adminDashboardController::class
    )->name('adminDashboard');

    Route::resource('cars', CarController::class);

    // Route::resource('reservations', ReservationController::class);

    Route::resource('insurances', InsuranceController::class);

    Route::get('/users', function () {

        $admins = User::where('role', 'admin')->get();
        $clients = User::where('role', 'client')->withCount('reservations')->paginate(5);

        return view('admin.users', compact('admins', 'clients'));
    })->name('users');

    Route::get('/updatePayment/{reservation}', [ReservationController::class, 'editPayment'])->name('editPayment');
    Route::put('/updatePayment/{reservation}', [ReservationController::class, 'updatePayment'])->name('updatePayment');

    Route::get('/updateReservation/{reservation}', [ReservationController::class, 'editStatus'])->name('editStatus');
    Route::put('/updateReservation/{reservation}', [ReservationController::class, 'updateStatus'])->name('updateStatus');

    Route::get('/addAdmin', [usersController::class, 'create'])->name('addAdmin');
    Route::post('/addAdmin', [addNewAdminController::class, 'register'])->name('addNewAdmin');

    // Route::delete('/deleteUser/{user}', [usersController::class, 'destroy'])->name('deleteUser');

    Route::get('/userDetails/{user}', [usersController::class, 'show'])->name('userDetails');

    Route::get('/site-content', [SiteContentController::class, 'edit'])->name('siteContent.edit');
    Route::put('/site-content', [SiteContentController::class, 'update'])->name('siteContent.update');

    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

// --------------------------------------------------------------------------//




// ------------------- client routes --------------------------------------- //

Route::get('/reservations/{car}', [ReservationController::class, 'create'])->name('car.reservation');
Route::post('/reservations/{car}', [ReservationController::class, 'store'])->name('car.reservationStore');

Route::get('/reservations', function () {

    $reservations = Reservation::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    return view('clientReservations', compact('reservations'));
})->name('clientReservation')->middleware('restrictAdminAccess');


route::get('invoice/{reservation}', [invoiceController::class, 'invoice'])->name('invoice')->middleware( 'restrictAdminAccess');


//---------------------------------------------------------------------------//



Route::get('/test', function () {
    return view('test');
})->name('test');



Auth::routes();
