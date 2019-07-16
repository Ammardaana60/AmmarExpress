<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;
use App\CartItem;
use Auth;
use Illuminate\Support\Facades\DB;
class checkIdCartItem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

     $cart_item=CartItem::find($request->segment(3));
      $cart=Cart::find($cart_item->cart_id);
      if($cart->user_id==Auth::user()->id)
        return $next($request);
        else {
            return response()->json('unauthorized to CRUD this cart');
        }
    }
}
