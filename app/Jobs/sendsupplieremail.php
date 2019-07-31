<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\productAddToCart;
use App\User;
class sendsupplieremail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
   // public $tries=1;
    public $user_id;
    public function __construct($user_id)
    {
        $this->user_id=$user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return User::find($this->user_id)->notify(new productAddToCart());
        
    }
}
