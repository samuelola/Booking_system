<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Resources\ShopIndexResource;
use App\Http\Resources\ShopShowResource;

class ShopController extends Controller
{
    public function index(){

          return ShopIndexResource::collection(Shop::orderByDesc('created_at')->get());
    }

    public function show($id){

        $getShopInfo = Shop::where('uuid',$id)->orderByDesc('created_at')->first();
        return new ShopShowResource($getShopInfo);
    }
}
