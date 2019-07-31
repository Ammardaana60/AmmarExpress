<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{
    protected $fillable=['from_user','to_user','cash'];
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
