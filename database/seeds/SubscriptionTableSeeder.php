<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Subscription;
use App\User;
use App\Category;
class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     $faker=Faker::create();
    //     for($i=0;$i<100;$i++){
    //         Subscription::create([
    //         'user_id'=>User::all()->random()->id,
    //         'category_id'=>Category::all()->random()->id,
    //         ]);
    //     }
    }
}
