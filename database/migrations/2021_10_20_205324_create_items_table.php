<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger("order_id");
            $table->unsignedInteger("product_id");
            $table->unsignedInteger("parent_id")->nullable();
            $table->unsignedInteger("type_id")->nullable();
            $table->unsignedInteger("size_id")->nullable();
            $table->string("comment")->nullable();
            $table->float("product_price");
            $table->float("price");
            $table->float("total");
            $table->float("sub_total"); // without discount
            $table->float("count");
            $table->float("discount_amount")->default(0)->nullable();
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
        Schema::dropIfExists('items');
    }
}
