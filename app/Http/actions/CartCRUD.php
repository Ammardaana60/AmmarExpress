<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\CartItem;
use App\Order;
use Auth;
use App\Http\Resources\CartResource;

class CartCRUD{
  public function create($request){
   Cart::create([
   'user_id'=>Auth::user()->id,
   'status'=>$request->status
   ]);
   cache::forget('cart.*');
   $carts=Cart::all();
   foreach($carts as $cart){
    Redis::hmset('cart.'.$cart->id,[
       'id' => $cart->id,
       'user_id' => $cart->user_id,
       'status' => $cart->status,
        ]);
    }
  }
  public function show($id){
    return response()->json(DB::connection()->select('select * from cart_items where cart_id='.$id));  
   }
  public function clearCart(){
   $cart=Cart::where('user_id','=',Auth::user()->id)->get();
   $cart->delete();
   Cache::forget('cart.'.Auth::user()->id);
  }
  public function buyNow($id){
  $cartitem=CartItem::where('cart_id','=',$id)->get();
     foreach($cartitem as $items){
        Order::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$items->product_id,
            'quantity'=>$items->quantity,
        ]);
      $items->delete();
      }       
      return 'done';
  }
}