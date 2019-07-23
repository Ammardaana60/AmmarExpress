<?php

namespace App\Http\Middleware;

use Closure;
use App\Brand;
use Auth;
class checkBrand
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {$brand=Brand::where('user_id','=',Auth::user()->id)->get();
        $check=Brand::find($request->brand_id);
        if($check->user_id==Auth::user()->id){
          if($brand->count()>0)
          return $next($request);
          else 
            return response()->json('please your create brand ');
        }else {
            return response()->json('not authorized to CRUD this brand');
        }      
    }
}
