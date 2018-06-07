<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        factory(\App\CategoryProduct::class, 300)->create();
//        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
