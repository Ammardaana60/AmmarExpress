<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class BrandFacade extends Facade{


    protected static function getFacadeAccessor()
    {
        return BrandCRUD::class;
    }
}