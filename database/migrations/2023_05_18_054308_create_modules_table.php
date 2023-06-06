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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('course_id'); 
            $table->string('user_id')->nullable(); 
            $table->text('title'); 
            $table->text('slug'); 
            $table->string('number_of_lesson'); 
            $table->string('number_of_attachment')->nullable();
            $table->string('number_of_video')->nullable();
            $table->string('duration'); 
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
        Schema::dropIfExists('modules');
    }
};
