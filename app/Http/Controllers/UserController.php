<?php

namespace App\Http\Controllers;

use App\Http\actions\UserFacade;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Auth;
class UserController extends Controller
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
