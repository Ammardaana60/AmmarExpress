<?php
namespace App\Http\actions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\User;
use Auth;
use App\Notifications\productAddToCart;

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
        'country_id'=>$request->country_id,
        'city_id'=>$request->city_id,
        'postal_code'=>$request->postal_code,

    ]);
    CartFacade::create($user->id);
    PocketFacade::create($user->id);
    $token=$user->createToken('dev')->accessToken;
    return $token;
}
public function sendEmail($supplier_id){
    $user=User::find($supplier_id);
    $user->notify(new productAddToCart());
}
}