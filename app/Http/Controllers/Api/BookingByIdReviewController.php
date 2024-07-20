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
        $rru = Booking::where('bookable_id',$id)->orderBy('id','asc')->first();
        if(!empty($rru->review_key)){
            return new BookingByIdResource($rru);
        }else{
            $rru = Booking::where('bookable_id',$id)->where('review_key','!=','')->orderBy('id','asc')->first();
            return new BookingByIdResource($rru);
        }
    }
}
