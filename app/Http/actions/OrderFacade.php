<?php
namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade {

protected static function getFacadeAccessor(){
    return OrderCRUD::class;
}

}
