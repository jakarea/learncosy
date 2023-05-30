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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('user_id')->nullable(); 
            $table->string('sub_title')->nullable(); 
            $table->string('features')->nullable(); 
            $table->string('slug')->nullable();
            $table->string('prerequisites')->nullable();
            $table->string('outcome')->nullable();
            $table->string('promo_video')->nullable();
            $table->string('price')->nullable();
            $table->string('offer_price')->nullable();
            $table->string('categories')->nullable();
            $table->string('thumbnail')->nullable()->default("thumbnail.png");
            $table->string('banner')->nullable()->default("thumbnail.png"); 
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('number_of_module')->nullable();
            $table->string('number_of_lesson')->nullable(); 
            $table->string('number_of_attachment')->nullable();
            $table->string('number_of_video')->nullable();
            $table->string('duration')->nullable();
            $table->string('hascertificate')->nullable()->default(0);
            $table->string('sample_certificates')->nullable()->default("thumbnail.png"); 
            $table->string('subscription_status')->default('one_time');
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
        Schema::dropIfExists('courses');
    }
};
