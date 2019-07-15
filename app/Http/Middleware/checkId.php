<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;
use App\Brand;
use Auth;
class checkId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*
    find the product from products table
    find the user_id
    */
    public function handle($request, Closure $next)
    {   $id=$request->segment(3);
        $product=Product::find($id);
    //   dd($product->brand_id);
    // dd(Auth::User()->id);
        $brand=Brand::find($product->brand_id);
       if($brand->user_id==Auth::user()->id)
            return $next($request);
        else
        return response()->json('not authorized for delete/update this topic');
    }
}
