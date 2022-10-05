<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('origin_id')->nullable();
            $table->unsignedInteger('discount_id')->nullable();
            $table->string('name',190);
            $table->string('slug',190);
            $table->string('image',190)->nullable();
            $table->float('price',10,2);
            $table->float('consist_quantity',10,2)->nullable();
            $table->float('width',10,2)->nullable();
            $table->float('height',10,2)->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->string('meta_tag_title', 190)->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->text('meta_tag_keywords')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedInteger('rank')->nullable()->default(1);
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
        Schema::dropIfExists('products');
    }
}
