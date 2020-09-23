<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopy_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->integer('count')->default(0);
            $table->string('currency', 5)->nullable()->default('vnd');
            $table->string('status', 20)->nullable()->default('pending');
            $table->string('payment_method', 20)->nullable();
            $table->string('delivery_status', 20)->nullable();
            $table->mediumText('note')->nullable();
            $table->integer('shipping_id')->default(0);

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
        Schema::dropIfExists('shopy_orders');
    }
}
