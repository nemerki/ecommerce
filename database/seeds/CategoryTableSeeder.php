<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table('categories')->truncate(); //seed çalıştırıldığında tablodaki tüm verileri siler
        $id=DB::table('categories')->insertGetId(['name'=>'Elektronik','slug'=>'elektronik']);
        DB::table('categories')->insert(['name'=>'Bilgisayar','slug'=>'bilgisayar','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Telefon','slug'=>'telefon','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Kamera','slug'=>'kamera','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Tv ve Ses Sistemleri','slug'=>'tv-ses-sistemleri','ust_id'=>$id]);


        $id=DB::table('categories')->insertGetId(['name'=>'Kitap','slug'=>'kitap']);
        DB::table('categories')->insert(['name'=>'Edebiyyat','slug'=>'kitap','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Tarih','slug'=>'tarih','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Çocuk','slug'=>'cocuk','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Sınavlara Hazırlık','slug'=>'sinavlara-hazirlik','ust_id'=>$id]);


        DB::table('categories')->insert(['name'=>'Dergi','slug'=>'dergi']);
        DB::table('categories')->insert(['name'=>'Mobilya','slug'=>'mobilya']);
        DB::table('categories')->insert(['name'=>'Dekarosyon','slug'=>'dekarasyon']);
        DB::table('categories')->insert(['name'=>'Kozmetik','slug'=>'kozmetik']);
        DB::table('categories')->insert(['name'=>'Kişisel Bakım','slug'=>'kisisel-bakim']);
        DB::table('categories')->insert(['name'=>'Giyim ve Moda','slug'=>'giyim-moda']);
        DB::table('categories')->insert(['name'=>'Anne ve Çocuk','slug'=>'anne-cocuk']);
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
