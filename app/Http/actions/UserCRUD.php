<?php
namespace App\Http\actions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\User;
use Auth;
use App\Cart;
use App\CartItem;
class UserCRUD {
public function login($request){
      $credintal=[
        'email'=>$request->email,
        'password'=>$request->password
    ];
    if(Auth::attempt($credintal)){
        $user = Auth::user(); 
        $token =  $user->createToken('dev')->accessToken; 
        return $token; 
    }else {
        return 'not authorized';
    }
}
public function register($request){
    $user=User::create([
        'email'=>$request->email,
        'name'=>$request->name,
        'password'=>Hash::make($request->password),
        'role'=>$request->role,
    ]);
CartFacade::create();
    PocketCRUD::createPocket();
    $token=$user->createToken('dev')->accessToken;
    
    return $token;
}

}