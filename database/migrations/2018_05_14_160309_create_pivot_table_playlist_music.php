<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTablePlaylistMusic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_music', function (Blueprint $table) {
            $table->integer('playlist_id')->unsigned();
            $table->integer('music_id')->unsigned();

            $table->foreign('playlist_id')
                ->references('id')
                ->on('playlists')
                ->onDelete('cascade');
            $table->foreign('music_id')
                ->references('id')
                ->on('musics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playlist_music');
    }
}
