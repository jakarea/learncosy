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
        Schema::create('vimeo_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('access_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vimeo_data');
    }
};
