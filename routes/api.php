<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bookable;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix'=>'V1'], function(){

    
});

Route::apiResource('bookables', BookableController::class)->only(['index','show']);
Route::get('bookables/{bookable}/availability',BookableAvailabilityController::class)
->name('bookables.availability.show');
Route::get('bookables/{bookable}/reviews',BookableReviewController::class)
->name('bookables.reviews.index');
Route::apiResource('reviews',ReviewController::class)->only(['show']);