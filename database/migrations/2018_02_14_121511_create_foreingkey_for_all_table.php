<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingkeyForAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actors', function (Blueprint $table)
        {

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('images', function (Blueprint $table)
        {

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('actor_movie', function (Blueprint $table)
        {
            $table->foreign('actor_id')->references('id')->on('actors');
            $table->foreign('movie_id')->references('id')->on('moviesMoviesSeeder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actor_movie', function (Blueprint $table)
        {
            $table->dropForeign(['movie_id','actor_id']);
        });
        Schema::table('images', function (Blueprint $table)
        {
            $table->dropForeign('user_id');
        });
        Schema::table('actors', function (Blueprint $table)
        {
            $table->dropForeign('user_id');
        });
    }
}
