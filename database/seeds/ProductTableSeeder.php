<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;
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
        for($i=0;$i<100;$i++){
            Product::create([
            'brand_id'=>App\Brand::all()->random()->id,
            'category_id'=>App\Category::all()->random()->id,
            'product_name'=>$faker->name(),
             'product_quantity'=>40,
             'product_rating'=>0,
             'properities'=>$faker->sentence,
             'tag'=>$faker->name,
             'ARproduct_name'=>'نْتُ أُرِيدُ أَنْ أَقْرَأَ كِتَابًا عَنْ تَارِيخِ ٱلْمَرْأَةِ فِي فَرَنْسَا',
             'ARproduct_description'=>'نَارِيخِ ٱلْمَرْأَةِ فِي فَرَنْسَا',
             'product_description'=> $faker->paragraph(),
             'product_price'=>1000,
             'images'=>$faker->url(),
            ]);
    }
    }
}
