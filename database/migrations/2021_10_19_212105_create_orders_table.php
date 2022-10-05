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
            $table->unsignedInteger("customer_id");
            $table->unsignedInteger("store_id")->nullable();
            $table->unsignedInteger("address_id")->nullable();
            $table->unsignedInteger("details_id")->nullable();
            $table->float("total");
            $table->float("sub_total"); // without discount
            $table->float("discount_amount")->default(0);
            $table->string("payment_type");
            $table->string("delivery_type")->default("pickup")->nullable();
            $table->tinyInteger("status")->default(2);
            $table->timestamp("send_date")->nullable();
            $table->timestamps();
            $table->softDeletes();
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
