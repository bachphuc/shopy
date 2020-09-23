<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShopyProductVariants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopy_product_variants', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->default(0);
            $table->integer('product_id');
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('count')->default(0);
            $table->string('image')->nullable();

            $table->tinyInteger('is_sold_out')->default(0);
            $table->tinyInteger('is_disabled')->default(0);
            $table->tinyInteger('total_sold')->default(0);

            $table->string('fields')->nullable();
            $table->string('values')->nullable();
            $table->string('search_values')->nullable();
            $table->string('search_fields')->nullable();
            $table->string('search')->nullable();

            $table->string('sku')->nullable();

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
        Schema::dropIfExists('shopy_product_variants');
    }
}
