<?php
namespace App\Http\actions;
use Illuminate\Support\Facades\Facade;
use App\Http\actions\ProductDetailsCRUD;
class ProductDetailsFacade extends Facade{
    
    protected static function getFacadeAccessor(){
        return ProductDetailsCRUD::class;
    }
}
