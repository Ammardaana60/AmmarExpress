<?php
namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;

class orderFacade extends Facade {

protected static function getFacadeAccessor(){
    return orderCRUD::class;
}

}
