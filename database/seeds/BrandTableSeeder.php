<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Brand;
use App\User;
use App\Category;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // 'brand_name','supplier_id'   // 
         $faker=Faker::create();
         for($i=0;$i<10;$i++){
             Brand::create([
             'brand_name'=>$faker->company(),
             'user_id'=>User::all()->random()->id,
             'category_id'=>Category::all()->random()->id,
             ]);
     }
    }
}
