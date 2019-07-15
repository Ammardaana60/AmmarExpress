<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Comment;
class CommentTableSeeder extends Seeder
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
            Comment::create([
            'comment'=>$faker->sentence,
            'user_id'=>App\User::all()->random()->id,
            'comment_rating'=>0,
            'product_id'=>App\Product::all()->random()->id,
            ]);
        }
    }
}
