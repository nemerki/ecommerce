<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use \App\Models\ProductDetail;
use \App\User;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
//        DB::table('products')->truncate(); //seed çalıştırıldığında tablodaki tüm verileri siler
//        factory(\App\Models\Product::class, 10)->create();
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        Product::truncate();
//        ProductDetail::truncate();
        for ($i = 0; $i < 300; $i++) {
            $tittle = $faker->streetName;
            $slug = str_slug($tittle);
            $product = Product::create([
                "tittle" => $tittle,
                "slug" => $slug,
                "description" => $faker->sentence(50),
                "price" => $faker->randomFloat(3, 1, 200),



            ]);

            $product_detail = $product->detail()->create([
                "slider" => rand(0, 1),
                "gunun_firsati" => rand(0, 1),
                "one_cikan" => rand(0, 1),
                "cok_satan" => rand(0, 1),
                "indirimli" => rand(0, 1),
            ]);
        }
//        DB::statement("SET FOREIGN_KEY_CHECKS=1");

    }
}
