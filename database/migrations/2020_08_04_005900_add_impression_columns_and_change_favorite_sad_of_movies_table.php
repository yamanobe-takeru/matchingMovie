<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImpressionColumnsAndChangeFavoriteSadOfMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->renameColumn('favorite','sad');
            $table->integer('funny')->default(0);
            $table->integer('scare')->default(0);
            $table->integer('moved')->default(0);
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
            $table->renameColumn('sad','favorite');
            $table->dropColumn('funny');
            $table->dropColumn('scare');
            $table->dropColumn('moved');
        });
    }
}
