<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AjukanController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ConfirmedOfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\BuyerProfileController;
use App\Http\Controllers\FisherController;
use App\Http\Controllers\FeedbackController;

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

Route::get('/', [GuestController::class, 'index']);

Auth::routes();

Route::resource('order', OrderController::class)->middleware('auth');
Route::resource('stock', StockController::class)->middleware('auth');
Route::resource('seller', SellerController::class)->middleware('auth');
Route::resource('offer', OfferController::class)->middleware('auth');
Route::resource('confirmed_offer', ConfirmedOfferController::class)->middleware('auth');
Route::resource('payment', PaymentController::class)->middleware('auth');
Route::resource('admin_profile', AdminProfileController::class)->middleware('auth');
Route::resource('buyer_profile', BuyerProfileController::class)->middleware('auth');
Route::resource('fisher', FisherController::class)->middleware('auth');
Route::resource('feedback', FeedbackController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');