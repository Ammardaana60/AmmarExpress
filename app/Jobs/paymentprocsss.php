<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\actions\transactionFacade;
use App\Http\actions\UserFacade;
use App\Http\actions\CartFacade;
use App\Http\actions\orderFacade;
use App\Http\actions\ProductFacade;
use App\Http\actions\CartItemFacade;
use App\Http\actions\AddressFacade;
use App\Pocket;
use Auth;
class paymentprocsss implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $cartItem,$user_id,$cartPrice;
    public function __construct($cartItem,$user_id,$cartPrice)
    {
        $this->cartItem=$cartItem;
        $this->user_id=$user_id;
        $this->cartPrice=$cartPrice;
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
        orderFacade::create($this->user_id);
        AddressFacade::create($this->user_id);
        CartItemFacade::ItemStatusUpdate($this->user_id);
        transactionFacade::create($this->cartItem,$this->user_id);
        ProductFacade::ProductStatus($this->cartItem);
        
        }catch(\Exception $e){
        \Log::info('fucken error:'.$e->getMessage());
    }
    }
}
