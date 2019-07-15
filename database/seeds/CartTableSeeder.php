<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Cart;
use App\User;
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
        $users=User::all();
        foreach($users as $user){
            Cart::create([
                'user_id'=>$user->id,
                'status'=>$faker->name,
            ]);
        }
    }
}