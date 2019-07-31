<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\actions\CartFacade;

class quantityupdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $quantity;
    public function __construct($quantity)
    {
        $this->quantity=$quantity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     CartFacade::UpdateQuantity($this->quantity);
    }
}
