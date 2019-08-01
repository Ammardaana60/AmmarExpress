<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=['user_id','order_id','country_id','city_id','postal_code'];
}
