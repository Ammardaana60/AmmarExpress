<?php

namespace App\Http\Middleware;

use Closure;
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
     $cart_id=DB::connection()->select('select cart_id from cart_item where id='.$request->segment(3));
     $user_id=DB::connection()->select('select user_id from cart_item where id='.$cart_id);
     if($user_id==Auth::user()->id)
        return $next($request);
        else {
            return 'unauthorized to CRUD this cart';
        }
    }
}
