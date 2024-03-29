<?php

namespace App\Http\actions;
use App\Productdetails;
use App\Cart;
use App\CartItem;
use Auth;
class CartCRUD{
public function create($id){
 Cart::create([
   'user_id'=>$id,
   'status'=>'new',
   ]); 
}
public function index(){
  return CartItem::where('cart_id','=',Auth::user()->id)->where('status','=',1)->get();  
}
public function totalPrice($items){
 $totalprice=0;
 foreach($items as $item){
 $itemDiscount=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->first();
    if($itemDiscount->quantity>=$item->quantity){
        $product=$item->product;
        $discount=$product->product_price*($product->discount+$itemDiscount->discount);
        $totalprice+=($product->product_price-$discount)*$item->quantity;
    }else{
       return 0;}
    return $totalprice;
    }
  }
 public function UpdateQuantity($items){
  foreach($items as $item){
    $product=$item->product;
    $productDet=Productdetails::where('product_id','=',$item->product_id)->where('color','=',$item->color)->where('size','=',$item->size)->first();
    if($product->product_quantity>0 and $productDet->quantity>0){
    $product->product_quantity= $product->product_quantity-$item->quantity;
    if($product->product_quantity==0){
      $product->status=0;
    }
    $productDet->quantity=$productDet->quantity-$item->quantity;
    if($productDet->quantity==0){
     $productDet->itemStatus=0;
    }
    $product->save();
    $productDet->save();
  }
}
}
}