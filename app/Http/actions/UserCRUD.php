<?php
namespace App\Http\actions;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
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
    }

    else {
        return 'not authorized';
    }
}
public function register($request){
    $user=User::create([
        'email'=>$request->email,
        'name'=>$request->name,
        'password'=>Hash::make($request->password),
    ]);
    $token=$user->createToken('dev')->accessToken;
    
    return $token;
}

}