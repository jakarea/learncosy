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
            $table->string('instructor_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->text('slug')->nullable();
            $table->string('selected_course');
            $table->string('regular_price')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
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
