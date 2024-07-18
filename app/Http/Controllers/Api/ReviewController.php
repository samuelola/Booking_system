<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function show($id){
        $review = Review::where('uuid',$id)->first();
        return $review ? new ReviewResource($review) : abort(404);
    }

    public function store(Request $request){
        
         $data = $request->validate(
            [
              'uuid'=> 'required|size:36|unique:reviews',
              'content' => 'required|min:2',
              'rating'  => 'required|in:1,2,3,4,5'
            ]
        );

        $booking = Booking::findByReviewKey($data['uuid']);

        if(null == $booking){
           return abort(404);
        }

        $booking->review_key = '';
        $booking->save();

        $review = Review::make($data);
        $review->booking_id = $booking->id;
        $review->bookable_id = $booking->bookable_id;
        $review->save();
        return new ReviewResource($review);
    }
}
