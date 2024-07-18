<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookingByIdResource;
use App\Models\Booking;

class BookingByIdReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$id)
    {
        return new BookingByIdResource(Booking::where('bookable_id',$id)->orderBy('id','desc')->first());


        
    }
}
