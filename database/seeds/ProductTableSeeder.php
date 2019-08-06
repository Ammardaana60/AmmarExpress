<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;
use App\Productdetails;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
            $faker=Faker::create();
            for($i=0;$i<50;$i++){
            $product=new Product();
            $product->brand_id=App\Brand::all()->random()->id;
            $product->category_id=App\Category::all()->random()->id;
            $product->product_name=$faker->name();
            $product->product_description=$faker->paragraph();
            $product->properities=$faker->sentence;
            $product->tag=$faker->name;
            $product->product_nameAR='َقْرَأَ كِتَابً';
            $product->product_descriptionAR='نْتُ أُرِيدُ أَنْ أَقْرَأَ كِتَابًا عَنْ تَارِيخِ ٱلْمَرْأَةِ فِي فَرَنْسَا';
            $product->product_price=1000;
            $product->status=1;
            $product->product_quantity=0;
            $product->save(); 
           }
           
    }
     
}

