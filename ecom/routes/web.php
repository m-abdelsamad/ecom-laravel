<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;


// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/bookSession', [HomeController::class, 'bookSession'])->name('bookSession');
Route::get('/downloadFiles', [HomeController::class, 'downloadFiles'])->name('downloadFiles');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'addCamera'])->name('dashboard.addCamera');
Route::post('/dashboard/addPromo', [DashboardController::class, 'addPromoCode'])->name('dashboard.addPromo');
Route::post('/dashboard/addCategory', [DashboardController::class, 'addCategory'])->name('dashboard.addCategory');
Route::post('/dashboard/addPost', [DashboardController::class, 'makeUpload'])->name('makeUpload');
Route::post('/dashboard/addAddress', [DashboardController::class, 'addAddress'])->name('addAddress');
Route::post('/dashboard/updatePassword', [DashboardController::class, 'updatePassword'])->name('updatePassword');
Route::post('/dashboard/addPayment', [DashboardController::class, 'addPayment'])->name('addPayment');
Route::post('/dashboard/addBranch', [DashboardController::class, 'addBranch'])->name('addBranch');
Route::post('/dashboard/setBranchSchedule', [DashboardController::class, 'setBranchSchedule'])->name('setBranchSchedule');
Route::post('/dashboard/addShootingSession', [DashboardController::class, 'addShootingSession'])->name('addShootingSession');
Route::post('/dashboard/removePayment/{id}', [DashboardController::class, 'removePayment'])->name('removePayment');
Route::post('/dashboard/updateAddress/{id}', [DashboardController::class, 'updateAddress'])->name('updateAddress');



Route::get('logout', [LogoutController::class, 'store'])->name('logout');

//Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::post('/store', [StoreController::class, 'searchFilter'])->name('store.searchFilter');
// Route::post('/store/{modelName}', [StoreController::class, 'getModels'])->name('getModels');
Route::get('/store/view/{camera}', [ViewItemController::class, 'index'])->name('viewItem');

Route::get('/store/addToCart/{camera}', [StoreController::class, 'addToCart'])->name('addToCart')->middleware(['auth']);
Route::post('/store/update', [StoreController::class, 'update'])->name('update');
Route::post('/store/remove/{id}', [StoreController::class, 'remove'])->name('remove');
// Route::get('/store/addQuantity/{camera}', [StoreController::class, 'addQuantity'])->name('addQuantity');
// Route::get('/store/decrementQuantity/{camera}', [StoreController::class, 'decrementQuantity'])->name('decrementQuantity');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware(['auth']);
Route::post('/testCart/promo_apply', [CheckoutController::class, 'applyPromoCode'])->name('applyPromoCode');
Route::post('/checkout', [CheckoutController::class, 'store']);


Route::get('/testCart', [CheckoutController::class, 'index'])->name('testCart');
Route::post('/testCart/checkedOut', [CheckoutController::class, 'checkout'])->name('checkedOut');
Route::post('/testCart/empty', [CheckoutController::class, 'emptyCart'])->name('emptyCart');