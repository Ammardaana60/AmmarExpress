<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;
class CategoryTableSeeder extends Seeder
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
            Category::create([
            'category_name'=>$faker->company(),
            'user_id'=>App\User::all()->random()->id,
             ]);
            }
    }
}
