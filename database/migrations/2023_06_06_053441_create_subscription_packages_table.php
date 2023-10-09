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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('sales_price', 10, 2)->nullable();
            $table->longText('features');
            $table->enum('type', ['monthly', 'yearly'])->default('monthly');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('subscription_packages');
    }
};
