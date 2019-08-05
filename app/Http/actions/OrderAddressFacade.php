<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class OrderAddressFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return OrderAddressCRUD::class;
    }
}