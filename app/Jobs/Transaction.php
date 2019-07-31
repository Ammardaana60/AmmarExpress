<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\actions\transactionFacade;
class Transaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $param;
    public function __construct($param)
    {
        $this->param=$param;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        try{
        transactionFacade::create($this->param);
        }catch(\Exception $e){
            \Log::info('transaction job is failed');
        }
    }

}
