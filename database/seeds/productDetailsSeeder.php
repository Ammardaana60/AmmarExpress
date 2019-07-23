<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Productdetails;
use App\Product;
class productDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker=Faker::create();
        for($i=0;$i<15;$i++){
            
            $productDetails=new Productdetails();
            $productDetails->size=$faker->name;
            $f=$productDetails->quantity=$faker->randomDigit;
            $productDetails->color=$faker->colorName;
            $x=$productDetails->product_id=Product::all()->random()->id;
            $productDetails->save();
            $product=Product::find($x);
            $product->product_quantity=$f;
            $product->save();
            }
           
    }
}
