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
            $table->integer('user_id')->nullable();
            $table->integer('course_id');
            $table->unsignedBigInteger('instructor_id');
            $table->integer('module_id');
            $table->text('title');
            $table->text('slug');
            $table->string('video_link', 191)->nullable();
            $table->string('thumbnail', 191);
            $table->text('short_description')->nullable();
            $table->string('status', 30)->default('pending');
            $table->string('type', 30)->default('video');
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
