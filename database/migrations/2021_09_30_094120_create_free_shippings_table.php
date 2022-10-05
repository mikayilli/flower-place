<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id");
            $table->string("name", 90);
            $table->unsignedInteger("min_amount");
            $table->unsignedInteger("percent");
            $table->unsignedInteger("limit");
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('free_shippings');
    }
}
