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
        Schema::create('bundle_selects', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->text('title')->nullable();
            $table->integer('instructor_id')->nullable();
            $table->text('slug')->nullable(); 
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->string('thumbnail', 191)->default('public/assets/images/courses/thumbnail.png');
            $table->longText('short_description')->nullable();
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
        Schema::dropIfExists('bundle_selects');
    }
};
