<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\CartItem;
use App\Product;
use App\Order;
use Auth;

class CartCRUD{
  public function create($id){
  Cart::create([
   'user_id'=>$id,
   'status'=>'new',
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
  public function show(){
    return response()->json(DB::connection()->select('select * from cart_items where cart_id='.Auth::user()->id));  
   }
  public function clearCart(){
    $cartitem=CartItem::where('cart_id','=',Auth::user()->id)->get();
    return response()->json($cartitem);
    Cache::forget('cart.'.Auth::user()->id.'item.*');
  }
  public function buyNow(){
  $cartitem=CartItem::where('cart_id','=',Auth::user()->id)->get();
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
  public function totalPrice(){
 $items=CartItem::where('cart_id','=',Auth::user()->id)->get();
 $totalprice=0;
 $check=CartFacade::checkQuantity();
 if($check!='not enough'){
 foreach($items as $item){
   $product=Product::find($item->product_id);
   $totalprice=$totalprice+($product->product_price*$item->quantity);
   $product->product_quantity= $product->product_quantity-$item->quantity;
   $product->save();
 }
 return $totalprice;
 }
 else {
   return "isn't enough";
 }
  }
  public function checkQuantity(){
    $items=CartItem::where('cart_id','=',Auth::user()->id)->get();
    //  dd($items);
     $totalprice=0;
     foreach($items as $item){
       $product=Product::find($item->product_id);
       if($product->product_quantity>=$item->quantity){
        continue;
      }else {
         return 'not enough';
       }
  
}
  }
}