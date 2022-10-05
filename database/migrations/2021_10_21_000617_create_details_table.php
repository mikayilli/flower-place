<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->string('sender_name')->nullable();
            $table->string('sender_phone');
            $table->string('sender_email')->nullable();
            $table->boolean('sender_provide_name')->default(0)->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone');
            $table->boolean('anonymous')->default(1)->nullable();
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
        Schema::dropIfExists('details');
    }
}
