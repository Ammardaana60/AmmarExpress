<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade{


    protected static function getFacadeAccessor()
    {
        return CartCRUD::class;
    }
}