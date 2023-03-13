<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('ship_id');
            $table->unsignedBigInteger('pay_id');
            $table->string('total');
            $table->string('status');
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('ship_id')->references('id')->on('shippings')->onDelete('cascade');
            $table->foreign('pay_id')->references('id')->on('payments')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
