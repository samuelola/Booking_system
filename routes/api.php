<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bookable;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookingByReviewController;
use App\Http\Controllers\Api\BookingByIdReviewController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookableSearchController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\NewPaymentController;
use App\Http\Controllers\Api\CountCartController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:api');
Route::get('user', [AuthController::class, 'user'])->name('user')->middleware('auth:api');

// Route::group(['prefix'=>'V1'], function(){

    
// });

Route::group(['middleware','api'],function(){
Route::apiResource('bookables', BookableController::class)->only(['index','show']);
Route::apiResource('reviews',ReviewController::class)->only(['show','store']);
Route::apiResource('search',BookableSearchController::class);
Route::apiResource('shops',ShopController::class);
Route::apiResource('cart',CartController::class);
Route::apiResource('checkout',CheckoutController::class);
Route::get('payment-callback',[NewPaymentController::class,'payment']);
Route::get('count-cart/{user_id}',[CountCartController::class,'countcart']);
Route::post('count-cart/{cart_id}/{user_id}',[CountCartController::class,'delete']);
Route::get('count-cart/{cart_id}/{user_id}',[CountCartController::class,'cartdetails']);
Route::put('count-cart/{cart_id}/{qty}/{totalprice}',[CountCartController::class,'updatecartdetails']);
});
//Route::apiResource('bookables', BookableController::class)->only(['index','show'])->middleware('auth:api');

Route::get('bookables/{bookable}/availability',BookableAvailabilityController::class)
->name('bookables.availability.show');
Route::get('bookables/{bookable}/reviews',BookableReviewController::class)
->name('bookables.reviews.index')->name('booking.by-review.show');
Route::get('booking-by-review/{reviewKey}',BookingByReviewController::class);
Route::get('booking-by/{id}',BookingByIdReviewController::class);


