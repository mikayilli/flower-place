<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("product_id")->nullable();
            $table->unsignedInteger("discount_id")->nullable();
            $table->string("name", 60)->nullable();
            $table->string("banner_name", 60);
            $table->string("slug", 190)->nullable()->unique();
            $table->string("image", 190)->nullable();
            $table->string("description", 190)->nullable();
            $table->string("meta_tag_title", 190)->nullable();
            $table->text("meta_tag_description")->nullable();
            $table->text("meta_tag_keywords")->nullable();
            $table->boolean("status")->default(1);
            $table->unsignedInteger("rank")->default(1);
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
        Schema::dropIfExists('collections');
    }
}
