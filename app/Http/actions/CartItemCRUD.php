<?php


namespace App\Http\actions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\CartItem;
use App\Product;
class CartItemCRUD {
public function create($request){
$product=Product::find($request->product_id);
if($product->product_quantity>=$request->quantity){
$item=CartItem::create([
'cart_id'=>$request->cart_id,
'product_id'=>$request->product_id,
'quantity'=>$request->quantity,
]);
 }
 else {
    return 'the quantity available isn'.$product->product_quantity;
 }
Cache::forget('cart.'.$request->cart_id);
$cartitems=CartItem::all();
foreach($cartitems as $cartitem){
Redis::hmset('cart.'.$request->cart_id.'item.'.$cartitem->id,[
'cart_id'=>$cartitem->cart_id,
'product_id'=>$cartitem->product_id,
'quantity'=>$cartitem->quantity,
]);
}
return $item;
}
public function update($request,$id){
 $item=CartItem::find($id);
 $product=Product::find($item->product_id);
 if($product->product_quantity>=$request->quantity){
 $item->quantity=$request->quantity;
 $item->save();
}
 else {
    return 'the quantity available isn'.$product->product_quantity;
}
 Redis::hmset('cart.'.$request->cart_id.'item.'.$item->id,[
'cart_id'=>$item->cart_id,
'product_id'=>$item->product_id,
'quantity'=>$item->quantity,
]);
return $item;
}
public function destroy($id){
$item=CartItem::find($id);
cache::forget('cart.'.$item->cart_id.'item'.$id);
$item->delete();
}

}