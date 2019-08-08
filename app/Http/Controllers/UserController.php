<?php

namespace App\Http\Controllers;

use App\Http\actions\UserFacade;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function login(loginRequest $request){
     return new UserResource(UserFacade::login($request));
       
    }
    public function register(registerRequest $request){
       return new UserResource(UserFacade::register($request));
    }
    public function details(){
        
        return new UserResource(Auth::user()); 
    }
}
