<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\actions\orderFacade;

class orderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user_id;
    public function __construct($id)
    {
     $this->user_id=$id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
    try{
       orderFacade::create($this->user_id);
    }catch(\Exception $e){
        \Log::info('order error'.$e->getMessage());
    }
    }
}
