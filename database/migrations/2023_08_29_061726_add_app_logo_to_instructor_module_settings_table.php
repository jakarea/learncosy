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
        Schema::table('instructor_module_settings', function (Blueprint $table) {
            $table->string('app_logo')->nullable()->after('apple_icon'); // Change 'existing_column' to the appropriate column name
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructor_module_settings', function (Blueprint $table) {
            $table->dropColumn('app_logo');
        });
    }
};