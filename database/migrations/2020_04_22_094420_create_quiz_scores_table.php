<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->bigInteger('quiz_id')->unsigned();
            $table->integer('score');
            $table->integer('movements');
            $table->integer('questions');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
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
        Schema::dropIfExists('quiz_scores');
    }
}
