<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopyOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopy_order_items', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->default(0);
            $table->integer('order_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('count')->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('currency', 5)->nullable()->default('vnd');
            $table->integer('variant_id')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopy_order_items');
    }
}
