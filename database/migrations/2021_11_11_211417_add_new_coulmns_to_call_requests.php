<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCoulmnsToCallRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_requests', function (Blueprint $table) {
            $table->date('date_at', )->useCurrent()->after('call_phone');
            $table->integer('count' )->default(0)->after('call_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_requests', function (Blueprint $table) {
            $table->dropColumn('date_at');
            $table->dropColumn('count');
        });
    }
}
