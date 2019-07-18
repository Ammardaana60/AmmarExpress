<?php

namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class PocketFacade extends Facade{

protected static function getFacadeAccessor()
{
    return PocketCRUD::class;
}


}