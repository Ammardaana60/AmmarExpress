<?php


namespace App\Http\actions;
use Auth;
use App\CartItem;
use App\Order;
use App\Http\Requests\CartItemRequest;
use App\Productdetails;
class CartItemCRUD {
public function create(CartItemRequest $request){
    $DataItem=Productdetails::where('product_id','=',$request->product_id)->where('color','=',$request->color)->where('size','=',$request->size)->first();
    if($DataItem->quantity>=$request->quantity){
    $item=new CartItem();
    $item->cart_id=Auth::user()->id;
    $item->size=$request->size;
    $item->color=$request->color;
    $item->quantity=$request->quantity;
    $item->product_id=$request->product_id;
    $item->save();
   }else {
    return 'the quantity available is'.$DataItem->quantity;
   }
 return $item;
}
public function update(CartItemRequest $request,$id){
    $item=CartItem::find($id);
    $DataItem=Productdetails::where('product_id','=',$request->product_id)->where('color','=',$request->color)->where('size','=',$request->size)->first();
    if($DataItem->quantity>=$request->quantity){
    $item->quantity=$request->quantity;
    $item->save();
    }else {
    return 'the quantity available isn'.$DataItem->quantity;
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
     $item->delete();
}
}