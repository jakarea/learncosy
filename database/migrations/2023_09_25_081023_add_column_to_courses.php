<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('curriculum')->nullable();
            $table->string('language')->nullable();
            $table->string('platform')->nullable();
            $table->longText('objective')->nullable();
            $table->longText('objective_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('curriculum');
            $table->dropColumn('language');
            $table->dropColumn('platform');
            $table->dropColumn('objective');
            $table->dropColumn('objective_details');
        });
    }
};
