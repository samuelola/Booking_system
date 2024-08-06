<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Cart;
use App\Http\Resources\CartShowResource;

class CartController extends Controller
{
    public function show(Request $request,$the_user_id){
        $user_cart = Cart::where('user_id',$the_user_id)->get();
       // return $user_cart;
        //$user_cart = Cart::where('user_id',$the_user_id)->with('shop')->get();
        return CartShowResource::collection($user_cart);
    }

    public function store(Request $request){
    
        $current_user = $request->user_id;
        $product_id = $request->product_id;
        $qty        = 1;
        $price      = $request->price;
        //check
        $basket = Cart::where('user_id',$current_user)->where('shop_id',$product_id)->first();
        if(!$basket){
           Cart::create([
               "user_id"=>$current_user,
               "shop_id" => $product_id,
               "qty"  => $qty,
               "price" => $price
           ]);
        }else{
           //update if product is already in cart table
           $basket->qty += 1;
           $basket->price += $price;
           $basket->save();  
        }

        $basket_count = Cart::where('user_id',$current_user)->sum('qty');
        return response()->json(['basket_count'=>$basket_count],200);
        
    }

    
}
