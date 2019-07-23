<?php

namespace App\Http\actions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Productdetails;
use App\Cart;
use App\CartItem;
use App\Product;
// use Productdetails;
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
    return response()->json(CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get());  
   }
   public function totalPrice(){
    $items=CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get();
    $totalprice=0;
    $check=CartFacade::checkQuantity();
    if($check==0){
      return 0;
    }else{
    foreach($items as $item){
      $itemDiscount=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->get();
      foreach($itemDiscount as $productdetails){
        $product=Product::find($item->product_id);
        $discount=$product->discount+$productdetails->discount;
       if($discount!=0){
         $prod=$product->product_price*$discount;
         $totalprice=$totalprice+($product->product_price-$prod)*$item->quantity;
         }else{
         $totalprice=$totalprice+$product->product_price*$item->quantity;
         }
    }
   }
   return $totalprice;
    }
  }

  public function checkQuantity(){
   $items=CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get();   //  dd($items);
   foreach($items as $item){
  $itemDiscount=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->get();
  foreach($itemDiscount as $productdetails){
    if($productdetails->quantity>=$item->quantity)
        continue;
    else
         return 0;
   }
  }
  return 1;
}
public function UpdateQuantity(){
  $items=CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get();
  foreach($items as $item){
    $product=Product::find($item->product_id);
    $product->product_quantity= $product->product_quantity-$item->quantity;
    if($product->product_quantity==0){
      $product->status=0;
    }
    $product->save();
    $productDet=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->get();
    foreach($productDet as $productDetails)
    $productDetails->quantity=$productDetails->quantity-$item->quantity;
    if($productDetails->quantity==0){
     $productDetails->itemStatus=0;
    }
    $productDetails->save();
  }
}
}