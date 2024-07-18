<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Resources\BookingByReviewShowResource;

class BookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$reviewKey)
    {
        $booking = Booking::findByReviewKey($reviewKey);
        return $booking ? new BookingByReviewShowResource($booking) : abort(404);
    }
}
