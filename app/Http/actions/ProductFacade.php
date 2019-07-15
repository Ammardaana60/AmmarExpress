<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;


class ProductFacade extends Facade{

    protected static function getFacadeAccessor(){
     return productCRUD::class;
    }
}