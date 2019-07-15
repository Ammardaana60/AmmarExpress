<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class CartItemFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return CartItemCRUD::class;
    }
}