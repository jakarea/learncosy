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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('course_id'); 
            $table->string('user_id')->nullable(); 
            $table->string('module_id'); 
            $table->text('title'); 
            $table->text('slug'); 
            $table->string('video_link')->nullable(); 
            $table->string('thumbnail'); 
            $table->string('lesson_file')->nullable()->default(''); 
            $table->text('short_description')->nullable(); 
            $table->text('meta_keyword')->nullable(); 
            $table->string('meta_description', 160)->nullable(); 
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('lessons');
    }
};
