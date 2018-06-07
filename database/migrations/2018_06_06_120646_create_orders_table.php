<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned();
            $table->decimal('amount', 10, 4);
            $table->string('status')->nullable();

            $table->string('name')->nullable();
            $table->string('adress')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank')->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('basket_id');

            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
