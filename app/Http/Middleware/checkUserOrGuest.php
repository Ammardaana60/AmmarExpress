<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\actions\CartItemFacade;
use JWTAuth;
class checkUserOrGuest
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
        
        //dd($request->header('Authorization'));
        if(Auth::check()){
            return $next($request);
        }
        else 
        {$check=$request->headers->has('Authorization');
        if($check)
        CartItemFacade::CreateForGuest();
         else
            return response()->json('please enter your missing information');
        
        }
    }
}
