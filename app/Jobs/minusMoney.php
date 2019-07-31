<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Pocket;

class minusMoney implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user_id;
    public $product_price;
    public function __construct($user_id,$product_price)
    {
        $this->user_id=$user_id;
        $this->product_price=$product_price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {//dd($this->user_id.'    '.$this->product_price);
        try{
            $supplier_pocket=Pocket::find($this->user_id);
            $supplier_pocket->cash=$supplier_pocket->cash + $this->product_price;
            $supplier_pocket->save();
        } catch(\Exception $e)
        {
            \Log::alert("The job is failing due to". $e->getMessage());
        }
    }
}
