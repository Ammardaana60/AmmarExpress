<?php
namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;
use App\Address;

class AddressFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return AddressCRUD::class;
    }
}