<?php


namespace App\Http\actions;
use Illuminate\Support\Facades\Cache;
use Auth;
use Illuminate\Support\Facades\Redis;
use App\CartItem;
use App\Product;
use App\User;
use App\Order;
use App\Http\Requests\CartItemRequest;
use App\Productdetails;
class CartItemCRUD {
public function create(CartItemRequest $request){
   $product=Product::find($request->product_id);
$quantity=Productdetails::where('product_id','=',$request->product_id)->where('color','=',$request->color)->where('size','=',$request->size)->get('quantity');
if($product->product_quantity>=$request->quantity){
  if($quantity>=$request->quantity){
   $item=new CartItem();
   $item->cart_id=Auth::user()->id;
   $item->size=$request->size;
   $item->color=$request->color;
   $item->quantity=$request->quantity;
   $item->product_id=$request->product_id;
   $item->save();
   }else {
      return response()->json('quantity of this color not enough');
   }
 }else {
    return 'the quantity available is'.$product->product_quantity;
 }
return $item;
}
public function CreateForGuest($request){
  $item=new CartItem();
   $item->token=$request->header('Authorization');
   $item->size=$request->size;
   $item->color=$request->color;
   $item->quantity=$request->quantity;
   $item->product_id=$request->product_id;
   $item->save();
   return $item;
}
public function update($request,$id){
 $item=CartItem::find($id);
 $product=Product::find($item->product_id);
 if($product->product_quantity>=$request->quantity){
 $item->quantity=$request->quantity;
 $item->save();
Redis::hmset('product.'.$product->id,[
    'id' => $product->id,
    'product_name' => $product->product_name,
    'product_description' => $product->product_description,
    'product_price' => $product->product_price,
    'product_quantity' => $product->product_quantity,
    'rating' => $product->rating,
    'brand_id'=>$product->brand_id,
    'category_id'=>$product->category_id,
    ]);
}
 else {
    return 'the quantity available isn'.$product->product_quantity;
}

return $item;
}
public function ItemStatusUpdate($id){
   $order=Order::where('user_id','=',$id)->latest()->first();
   $items=CartItem::where('cart_id','=',$id)->get();
   foreach($items as $item){
      $item->status=0;
      $item->order_id=$order->id;
      $item->save();
   }
 
}
public function destroy($id){
$item=CartItem::find($id);
cache::forget('cart.'.$item->cart_id.'item'.$id);
$item->delete();
}

}