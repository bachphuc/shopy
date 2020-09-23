<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShopyCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopy_categories', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->default(0);
            $table->string('title')->nullable();
            $table->string('alias')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail_120')->nullable();
            $table->string('thumbnail_300')->nullable();
            $table->string('thumbnail_500')->nullable();
            $table->string('thumbnail_720')->nullable();
            $table->integer('parent_category_id')->nullable()->default(0);
            $table->string('gender')->nullable();
            $table->integer('total_product')->default(0);

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
        Schema::dropIfExists('shopy_categories');
    }
}
