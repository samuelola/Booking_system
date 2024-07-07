<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bookable;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookableAvailabilityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix'=>'V1'], function(){

    
});

Route::apiResource('bookables', BookableController::class)->only(['index','show']);

Route::get('bookables/{bookable}/availability',BookableAvailabilityController::class)
->name('bookables.availability.show');

