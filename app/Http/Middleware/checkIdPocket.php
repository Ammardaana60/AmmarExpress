<?php

namespace App\Http\Middleware;

use Closure;
use App\pocket;
use Auth;
class checkIdPocket
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
        $pocket=Pocket::find(Auth::user()->id);
        if($pocket->user_id==Auth::user()->id){
        return $next($request);
        }else {
            return response()->json('not authorize to update this pocket');
        }
    }
}
