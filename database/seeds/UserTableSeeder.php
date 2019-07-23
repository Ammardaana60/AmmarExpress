<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Http\actions\CartFacade;
use App\Http\actions\PocketFacade;
class UserTableSeeder extends Seeder
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
            $user=User::create([
                'email'=>$faker->email(),
                'name'=>$faker->name(),
                'password'=>Hash::make('fakerfaker'),
                'country_id'=>$faker->randomDigit,
                'city_id'=>$faker->randomDigit,
                'postal_code'=>$faker->randomDigit,
            ]);
            $token=$user->createToken('dev')->accessToken;
            CartFacade::create($user->id);
            PocketFacade::create($user->id);

        }
    }
}
