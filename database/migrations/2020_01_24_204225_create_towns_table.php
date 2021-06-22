<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // name for the admin database list
            $table->string('title'); // the title visible throughout the application
            $table->text('info'); // the information about the program
            $table->string('slug')->unique(); // slug to be assigned in order to find the record from the URL
            $table->string('logo')->nullable(); // logo of the municipality
            $table->string('background')->nullable(); // image background of the pages
            $table->text('css')->nullable(); // css to be used for the municiaplity (font etc defined)
            $table->string('game_background')->nullable();
            $table->string('game_player')->nullable();
            $table->string('game_question')->nullable();
            $table->string('game_obstacle')->nullable();
            $table->bigInteger('municipality_id')->unsigned()->nullable();
            $table->foreign('municipality_id')->references('id')->on('municipalities');
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
        Schema::dropIfExists('towns');
    }
}
