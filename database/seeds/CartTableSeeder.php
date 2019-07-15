<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Cart;
class CartTableSeeder extends Seeder
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
            Cart::create([
            'user_id'=>App\User::all()->random()->id,
            // 'product_id'=>App\Product::all()->random()->id,
            // 'quantity'=>$faker->randomDigit(),
            'status'=>$faker->name,
            ]);
        }
    }
}
