<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookable;
use App\Http\Resources\BookableIndexResource;

class BookableSearchController extends Controller
{
    public function show($search){
        
        $search_bookable = Bookable::where('title','like',"%$search%")->orderByDesc('created_at')->get();
        if($search_bookable->count() > 0){
            return BookableIndexResource::collection($search_bookable);
        }else{
            abort(404);
        }
    }
}
