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
        Schema::create('bundle_courses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); 
            $table->text('title'); 
            $table->text('slug')->nullable(); 
            $table->string('selected_course'); 
            $table->string('subscription_status')->default('one_time'); 
            $table->string('price')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('status')->default('draft');
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
        Schema::dropIfExists('bundle_courses');
    }
};
