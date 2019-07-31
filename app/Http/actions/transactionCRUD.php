<?php
namespace App\Http\actions;
use App\Transaction;
use Auth;
use App\Pocket;
class transactionCRUD{
 public function create($cartItem,$id){
  foreach($cartItem as $item){
    $itemDiscount=0;
    $brand=$item->product->brand;
    $product=$item->product;
    $discount=$item->product->discount+$itemDiscount;
    $actualDiscount=$product->product_price*$discount;
    $toPocket=Pocket::find($brand->user_id);
    $toPocket->cash+=$product->product_price-$actualDiscount;
    $toPocket->save();
    $transaction=new Transaction();
    $transaction->from_user=$id;
    $transaction->to_user=$brand->user_id;
    $transaction->cash=$product->product_price-$actualDiscount;
    $transaction->save();
   
 }
}
 
}