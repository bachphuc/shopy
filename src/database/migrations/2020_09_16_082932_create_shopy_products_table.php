<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopy_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('user_id')->nullable()->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('count')->default(0);
            $table->string('alias')->nullable();
            $table->integer('category_id')->default(0);
            $table->string('currency', 5)->nullable()->default('vnd');

            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_featured')->default(0);

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
        Schema::dropIfExists('shopy_products');
    }
}
