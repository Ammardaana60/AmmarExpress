<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\actions\ProductFacade;

// use lang;/*  */
class checlocale
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
         $lang=$request->segment(4);
        if($lang=='en'){
          return response()->json(ProductFacade::index());
        }else if($lang=='ar'){
         return response()->json(ProductFacade::AR_index());
        }else{
            return response()->json('language not support');
        }
        return $next($request);
    }
}
