<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Cart;
use Auth;
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
  public function destroy($id){
  $cart=Cart::find($id);
  $cart->delete();
  Cache::forget('cart.'.$id);
 }
  public function clearCart(){
   $cart=Cart::where('user_id','=',Auth::user()->id)->get();
   $cart->delete();
   Cache::forget('cart.'.Auth::user()->id);
  }
  public function show($id){
  // $keys=Redis::keys('cart.'.$id);
  // $items=[];
  // dd($keys);
  // foreach($keys as $key){
  //   // $item[]=Redis::hgetall('cart.'.$id.'cartItem.'.)
  // }
  return cache::get('cart.'.$id.'.*');    
  
  }
  public function buyNow(){
    $cart=Cart::where('user_id','=',Auth::user()->id);
    foreach($cart->cart_items as $items){
             Order::create([
            'user_id'=>$cart->user_id,
            'product_id'=>$items->product_id,
            'quantity'=>$items->quantity,
        ]);
        
        $cart->status="paid";
        $cart->save();
    }
  }
}