<?php
namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;
use App\Transaction;
class transactionFacade extends Facade{
  
    protected static function getFacadeAccessor()
    {
        return transactionCRUD::class;
    }
}