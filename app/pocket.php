<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pocket extends Model
{
    protected $fillable=['user_id','cash','currency'];
    public function user(){
        return belongsTo(User::class);
    }
}
