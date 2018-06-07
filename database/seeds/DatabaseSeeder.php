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
//         $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(ProductTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);


//        factory(\App\User::class, 10)->create();
//        factory(\App\Models\Product::class, 10)->create();
//        factory(\App\Models\Category::class,10)->create();


    }
}
