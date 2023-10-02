<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
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
            $table->tinyInteger('auto_complete')->default(1);
            $table->integer('user_id')->nullable();
            $table->text('slug')->nullable();
            $table->string('promo_video', 191)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->text('categories')->nullable();
            $table->string('thumbnail', 191)->default('public/assets/images/courses/thumbnail.png');
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->tinyInteger('hascertificate')->default(0);
            $table->string('sample_certificates', 191)->nullable();
            $table->string('status', 25)->default('draft');
            $table->tinyInteger('allow_review')->default(1);
            $table->string('language', 30)->nullable();
            $table->string('platform', 50)->nullable();
            $table->longText('objective')->nullable();
            $table->string('curriculum', 191)->nullable();
            $table->longText('objective_details')->nullable();
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
}
