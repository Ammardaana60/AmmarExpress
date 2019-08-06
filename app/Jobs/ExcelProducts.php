<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Product;
use Storage;
class ExcelProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $product;
    public function __construct($product)
    {
        $this->product=$product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {try{
        $url = $this->product['picture'];
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put($name, $contents);
        $product=new Product();
        $product->addMediaFromUrl($url)->toMediaCollection();
        $product->brand_id=$this->product['brand_id'];
        $product->discount=$this->product['discount'];
        $product->category_id=$this->product['category_id'];
        $product->product_name=$this->product['product_name'];
        $product->product_description=$this->product['product_description'];
        $product->properities=$this->product['properities'];
        $product->tag=$this->product['tag'];
        $product->product_nameAR=$this->product['Arproduct_name'];
        $product->product_descriptionAR=$this->product['Arproduct_description'];
        $product->product_price=$this->product['product_price'];
        $product->status=1;
        $product->product_quantity=0;
        $product->save(); 
    }
    catch(\Exception $e){
        \Log::error('hello'.$e->getMessage());
    }
}
}
