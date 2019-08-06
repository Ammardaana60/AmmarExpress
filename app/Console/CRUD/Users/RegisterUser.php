<?php
namespace App\Console\Actions\UserCRUD;
///var/www/html/markets/app/Console/Actions/UserCRUD/RegisterUser.php
class RegisterUser{
public $request;
public function __construct($request)
{
    $this->request=$request;
    
}

public function handle()
{ 
    $user=User::create([
        'email'=>$this->request->email,
        'name'=>$this->request->name,
        'password'=>Hash::make($this->request->password),
        'role'=>$this->request->role,
        'country_id'=>$this->request->country_id,
        'city_id'=>$this->request->city_id,
        'postal_code'=>$this->request->postal_code,
    ]);
    CartFacade::create($user->id);
    PocketFacade::create($user->id);
    $token=$user->createToken('dev')->accessToken;
    return $token;
}
}