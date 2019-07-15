<?php

namespace App\Http\Middleware;

use Closure;
use App\Brand;
use Auth;
class checkIdBrand
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
        $brand=Brand::find($request->segment(3));
        if(Auth::user()->id==$brand->user_id)
           return $next($request);
        else {
            return response()->json('not authorized to update/detele this brand');
        }
    }
}
