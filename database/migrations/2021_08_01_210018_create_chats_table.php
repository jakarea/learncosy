<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sender_id');
            $table->bigInteger('receiver_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->longText('message')->nullable();
            $table->string('file')->nullable();
            $table->string('file_extension', 50)->nullable();
            $table->tinyInteger('file_type')->default(1)->comment('1:Message, 2:File');
            $table->tinyInteger('message_type')->default(1)->comment('1:Personal message, 2:Group message');
            $table->tinyInteger('is_read')->default(false);

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
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
        Schema::dropIfExists('chats');
    }
}
