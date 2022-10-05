<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("full_name", 90);
            $table->string("phone", 20)->unique();
            $table->string("email", 50)->unique();
            $table->string("password");
            $table->boolean("subscribe")->default(0)->nullable();
            $table->boolean("personal_info")->default(1)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(1);
            $table->integer("otp")->nullable();
            $table->boolean("block")->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
