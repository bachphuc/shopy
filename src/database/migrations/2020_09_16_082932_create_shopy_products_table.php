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
            $table->string('title')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->string('image')->nullable()->default('');
            $table->integer('user_id')->nullable()->default(0);
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
