<?php
namespace App\Http\actions;
use Illuminate\Support\Facades\Facade;
use App\Http\actions\productDetailsCRUD;
class productDetailsFacade extends Facade{
    
    protected static function getFacadeAccessor(){
        return productDetailsCRUD::class;
    }
}
