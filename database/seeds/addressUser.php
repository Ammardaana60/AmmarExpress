<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Factory as Faker;
use App\Address;

class addressUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($i=0;$i<10;$i++){
            Address::create([
             'country_id'=>$faker->randomDigit,
             'city_id'=>$faker->randomDigit,
             'postal_code'=>$faker->randomDigit,
             'user_id'=>App\User::all()->random()->id,
            ]);
        }
    }
}
