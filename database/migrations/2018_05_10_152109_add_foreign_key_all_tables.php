<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlists', function (Blueprint $table){
           $table->foreign('user_id')
               ->references('id')
               ->on('users')
               ->onDelete('cascade');
           $table->foreign('music_id')
               ->references('id')
               ->on('musics')
               ->onDelete('cascade');
        });
        Schema::table('musics', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('playlists', function (Blueprint $table){
            $table->dropForeign('playlists_user_id_foreign');
            $table->foreign('playlists_music_id_foreign');
        });
        Schema::create('musics', function (Blueprint $table) {
            $table->dropForeign('playlists_user_id_foreign');
            $table->foreign('playlists_genre_id_foreign');
        });
        Schema::create('articles', function (Blueprint $table) {
            $table->dropForeign('playlists_user_id_foreign');
        });
    }
}
