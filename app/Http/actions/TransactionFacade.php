<?php
namespace App\Http\actions;

use Illuminate\Support\Facades\Facade;
use App\Transaction;
class TransactionFacade extends Facade{
  
    protected static function getFacadeAccessor()
    {
        return TransactionCRUD::class;
    }
}