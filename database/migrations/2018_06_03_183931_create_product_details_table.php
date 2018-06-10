<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id")->unsigned()->unique();
            $table->boolean("slider")->default(0);
            $table->boolean("gunun_firsati")->default(0);
            $table->boolean("one_cikan")->default(0);
            $table->boolean("cok_satan")->default(0);
            $table->boolean("indirimli")->default(0);
            $table->string("product_img",250);
            $table->timestamps();

            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
