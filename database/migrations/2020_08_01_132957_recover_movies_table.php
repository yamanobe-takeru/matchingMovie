<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecoverMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::table('movies', function (Blueprint $table) {
         Schema::create('movies', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->text('title');
            $table->string('content');
            $table->string('cast');
            $table->string('director');
            $table->string('time');
             $table->integer('genre_id');
             $table->integer('user_id');

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
        Schema::table('movies', function (Blueprint $table) {
            $table->dropIfExists('movies');
        });
    }
}
