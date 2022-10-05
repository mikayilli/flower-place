<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPromos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->enum("type", ["percent", "fix"])->after('quantity');
            $table->float("min_amount")->after('quantity')->nullable();
            $table->float("max_amount")->after('quantity')->nullable();
            $table->float("fix_amount")->after('quantity')->nullable();
            $table->unsignedInteger("percent")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('min_amount');
            $table->dropColumn('max_amount');
            $table->dropColumn('fix_amount');
            $table->unsignedInteger("percent")->change();
        });
    }
}
