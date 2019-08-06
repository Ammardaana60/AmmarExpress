<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\actions\TransactionFacade;
use App\Http\actions\UserFacade;
use App\Http\actions\CartFacade;
use App\Http\actions\OrderFacade;
use App\Http\actions\ProductFacade;
use App\Http\actions\CartItemFacade;
use App\Http\actions\AddressFacade;
use App\Pocket;
use Auth;
use App\Http\actions\OrderAddressFacade;

class paymentprocsss implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $cartItem,$user_id,$cartPrice,$address_id;
    public function __construct($cartItem,$user_id,$cartPrice,$address_id)
    {
        $this->cartItem=$cartItem;
        $this->user_id=$user_id;
        $this->cartPrice=$cartPrice;
        $this->address_id=$address_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {try{      
        $pocket=Pocket::find($this->user_id);
        $pocket->cash=$pocket->cash-$this->cartPrice;
        $pocket->save();
        CartFacade::UpdateQuantity($this->cartItem);
        OrderFacade::create($this->user_id);
      //  AddressFacade::create($this->user_id);
        OrderAddressFacade::createOrderAddress($this->user_id,$this->address_id);
        CartItemFacade::ItemStatusUpdate($this->user_id);
        TransactionFacade::create($this->cartItem,$this->user_id);
        ProductFacade::Status($this->cartItem);
        
        }catch(\Exception $e){
        \Log::info('fucken error:'.$e->getMessage());
    }
    }
}
