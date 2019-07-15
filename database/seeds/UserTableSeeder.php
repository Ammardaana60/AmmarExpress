<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
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
            ]);
            $token=$user->createToken('dev')->accessToken;

        }
    }
}
