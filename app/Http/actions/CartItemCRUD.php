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
$product->product_quantity=$product->product_quantity-$request->quantity;
$product->save();
$item=CartItem::create([
'cart_id'=>Auth::user()->id,
'product_id'=>$request->product_id,
'quantity'=>$request->quantity,
]);
 }
 else {
    return 'the quantity available isn'.$product->product_quantity;
 }
Cache::forget('cart.'.Auth::user()->id);
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
 $product->product_quantity=$product->product_quantity-$request->quantity;
 $product->save();
 $item->quantity=$request->quantity;
 $item->save();
 Cache::put('product.'.$product->id,[
    'id' => $product->id,
    'product_name' => $product->product_name,
    'product_description' => $product->product_description,
    'product_price' => $product->product_price,
    'product_quantity' => $product->product_quantity,
    'product_rating' => $product->product_rating,
    'brand_id'=>$product->brand_id,
    'category_id'=>$product->category_id,
    'images'=>$product->image,
    ]);
}
 else {
    return 'the quantity available isn'.$product->product_quantity;
}
 Cache::put('cart.'.Auth::user()->id.'item.'.$item->id,[
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