<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['comment','comment_rating','user_id','product_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
