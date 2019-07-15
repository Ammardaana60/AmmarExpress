<?php

namespace App\Http\actions;

// use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return UserCRUD::class;
    }

}