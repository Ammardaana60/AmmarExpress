<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\actions\UserFacade;

use App\Http\Requests\loginRequest;
// use App\Http\Controllers\UserFacade;
use App\Http\Requests\registerRequest;
use Auth;
class usercontroller extends Controller
{
    public function login(loginRequest $request){
     $x=UserFacade::login($request);
       return response()->json($x);
    }
    public function register(registerRequest $request){
       $x=UserFacade::register($request);
       return response()->json($x);
    }
    public function details(){
        
        return response()->json(Auth::user()); 
    }
}
