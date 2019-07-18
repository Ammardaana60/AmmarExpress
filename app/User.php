<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function items(){
        return $this->hasMany(CartItem::class);
    }
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function brands(){
        return $this->hasMany(Brand::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function cart(){
     return $this->hasOne(Cart::class);
     }
   public function pocket(){
       return $this->hasOne(pocket::class);
   }
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
