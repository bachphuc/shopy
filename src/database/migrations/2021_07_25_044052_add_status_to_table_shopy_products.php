<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToTableShopyProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopy_products', function (Blueprint $table) {
            $table->string('status')->nullable()->default('draft');
            $table->tinyInteger('is_remove_from_sale')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopy_products', function (Blueprint $table) {
            //
        });
    }
}
