<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizMathTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_math', function (Blueprint $table) {
            $table->bigInteger('math_id')->unsigned();
            $table->bigInteger('quiz_id')->unsigned();
            $table->foreign('math_id')->references('id')->on('maths')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes') ->onDelete('cascade');
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
        Schema::dropIfExists('quiz_math');
    }
}
