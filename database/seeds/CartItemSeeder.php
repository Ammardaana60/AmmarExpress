<?php

use Illuminate\Database\Seeder;
use App\CartItem;
use Faker\Factory as Faker;
use App\Product;
use App\Cart;
class CartItemSeeder extends Seeder
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
            CartItem::create([
                'product_id'=>Product::all()->random()->id,
                'cart_id'=>Cart::all()->random()->id,
                'quantity'=>$faker->randomDigit(),
            ]);
        }
    }
}
