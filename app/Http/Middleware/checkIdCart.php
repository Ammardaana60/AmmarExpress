<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;
use Auth;
use Illuminate\Support\Facades\DB;
class checkIdCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {    $id=$request->segment(3);
        $cart=Cart::find($id);
        if($cart->user_id=Auth::user()->id){
           return $next($request);
         }
        else {
            return response()->json('unauthorized to update this cart');
        }
    }
}
