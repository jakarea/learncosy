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
            $table->text('title'); 
            $table->string('auto_complete')->nullable()->default(1);
            $table->string('user_id')->nullable(); 
            $table->text('sub_title')->nullable(); 
            $table->text('features')->nullable(); 
            $table->text('slug')->nullable();
            $table->text('prerequisites')->nullable();
            $table->text('outcome')->nullable();
            $table->string('promo_video')->nullable();
            $table->string('price')->nullable();
            $table->string('offer_price')->nullable();
            $table->text('categories')->nullable();
            $table->string('thumbnail')->nullable()->default("public/assets/images/courses/thumbnail.png");
            $table->string('banner')->nullable()->default("suggested-banner.png"); 
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('meta_description', 160)->nullable(); 
            $table->string('number_of_module')->nullable();
            $table->string('number_of_lesson')->nullable(); 
            $table->string('number_of_attachment')->nullable();
            $table->string('number_of_video')->nullable();
            $table->string('duration')->nullable();
            $table->string('hascertificate')->nullable()->default(0);
            $table->string('sample_certificates')->nullable()->default(""); 
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
