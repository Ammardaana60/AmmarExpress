<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(productDetailsSeeder::class);
        $this->call(CommentTableSeeder::class);
        // $this->call(SubscriptionTableSeeder::class);
        // $this->call(CartTableSeeder::class);
        // $this->call(CartItemSeeder::class);




    }
}
