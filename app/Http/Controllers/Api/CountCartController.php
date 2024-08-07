<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CountCartController extends Controller
{
    public function countcart(Request $request,$user_id){
          $basket_count = Cart::where('user_id',$user_id)->sum('qty');
          return response()->json(['basket_count'=>$basket_count],200);
          
    }

    public function cartdetails($id,$user_id){

        $get_cart = Cart::where(['id'=>$id,'user_id'=>$user_id])->first();
        $total_cart = $get_cart->qty * $get_cart->price;
        return response()->json(['basket_counter'=> $total_cart],200);
    }

    public function updatecartdetails($id,$qty,$totalprice){

         $cart = Cart::find($id);
         $cart->qty = $qty;
         $cart->price = $totalprice;
         $cart->save();
         return response()->json(['cart_updated'=> $cart],200);
    }

    public function delete($id,$user_id){
        $get_cart = Cart::where('id',$id)->delete();
        $basket_count = Cart::where('user_id',$user_id)->sum('qty');
        return response()->json(['basket_count'=> $basket_count],200);
    }
}
