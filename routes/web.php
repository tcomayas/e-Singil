<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Facades\Charts;
use App\Http\Controllers\HomeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single Listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit Listing
// update - update Listing
// destroy - Delete a Listing

//Listings Controller
Route::get('/', [ListingController::class, 'index'])->middleware('auth');
Route::get('/users/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::get('/users/listings/inventory', [ListingController::class, 'display'])->middleware('auth');
Route::get('/listings/product', [ListingController::class, 'getProducts'])->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
Route::get('/users/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->middleware('auth');
Route::post('/debtor/{id}', [ListingController::class, 'buyNow'])->name('debtor');
Route::get('/debtor', [ListingController::class, 'showListingsDebtor'])->middleware('auth')->name('debtor');
Route::get('/components/cart', [ListingController::class, 'showCartComponents'])->middleware('auth');
Route::get('/cart', [ListingController::class, 'showCart'])->middleware('auth');
Route::get('/debt', [ListingController::class, 'showDebts']);
Route::post('/pending/{id}', [ListingController::class, 'acceptPending'])->name('pending');
Route::post('/payment', [ListingController::class, 'payment'])->name('payment');
Route::get('/pending', [ListingController::class, 'showPending']);
Route::get('/debtor-history', [ListingController::class, 'showDebtorHistory']);
Route::get('/history', [ListingController::class, 'showHistory']);
Route::get('/debtor-profile', [ListingController::class, 'showDebtorsProfile']);
Route::get('/debtor-payment', [ListingController::class, 'showDebtorProfile'])->name('debtorpayment');
Route::post('/debtor-payment/{id}', [ListingController::class, 'partialPayment'])->name('partialpayment');
Route::post('/full-payment/{id}', [ListingController::class, 'fullPayment'])->name('full');
Route::get('/users/authenticate', [ListingController::class, 'index']);
Route::post('/notification/clear', [ListingController::class, 'clearNotif'])->name('clearNotif');
Route::get('/debtor-notification', [ListingController::class, 'showNotification'])->name('showNotification');
Route::post('/add/sales', [ListingController::class, 'addSales'])->name('addSales');
Route::get('/sales', [ListingController::class, 'showSales']);
// Route::get('/', [ListingController::class, 'totalRevenue'])->name('totalRevenue');

// USER CONTROLLERS
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout',[UserController::class, 'logout'])->name('logout');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
Route::get('/profile/show', [UserController::class, 'showProfile'])->middleware('auth');

// CHART CONTROLLERS
// Route::get('/', [ChartController::class, 'index'])->middleware('auth');

//HOME CONTROLLERS
Route::get('/redirect', [HomeController::class, 'index'])->middleware('auth');

Route::middleware([
])->group(function () {
    Route::get('/debtor', function () {
        $listings = fetchListingsForAllUsers();

        return view('debtor', compact('listings'));
    })->name('debtor');
});

function fetchListingsForAllUsers() {
    return Listing::paginate(10);
}
