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
            $table->string('module_id'); 
            $table->string('title'); 
            $table->string('slug'); 
            $table->string('video_link')->nullable(); 
            $table->string('thumbnail'); 
            $table->string('lesson_file')->nullable(); 
            $table->string('short_description')->nullable(); 
            $table->string('meta_keyword')->nullable(); 
            $table->longText('meta_description')->nullable(); 
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
        Schema::dropIfExists('lessons');
    }
};
