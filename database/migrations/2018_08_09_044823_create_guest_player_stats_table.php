<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestPlayerStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_player_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->unique();
            $table->integer('answered');
            $table->integer('corrects_answer');
            $table->integer('points');
            $table->integer('current_level');
            $table->jsonb('current_level_words');
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
        Schema::dropIfExists('guest_player_stats');
    }
}
