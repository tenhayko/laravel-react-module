<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_one');
            $table->unsignedInteger('user_two');
            $table->unsignedInteger('conversation_id');
            $table->foreign('user_one')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_two')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_conversations');
    }
}
