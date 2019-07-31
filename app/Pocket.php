<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pocket extends Model
{   protected $fillable=['user_id','cash','currency'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
