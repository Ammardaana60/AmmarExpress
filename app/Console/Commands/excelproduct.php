<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\actions\ProductFacade;

class excelproduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:excel {FileNameAndPath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reading the products data from Excel file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('FileNameAndPath');
        ProductFacade::readExcelFile($file);
        
    }
}
