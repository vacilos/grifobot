<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('level');
            $table->text('question');
            $table->string('answer', 255);

            $table->string('answer_alt1', 255)->nullable()->default(null);
            $table->string('answer_alt2', 255)->nullable()->default(null);
            $table->string('answer_alt3', 255)->nullable()->default(null);
            $table->string('answer_alt4', 255)->nullable()->default(null);

            $table->unsignedBigInteger('creator_user_id')->default(1)->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('updater_user_id')->default(1)->nullable();
            $table->foreign('updater_user_id')->references('id')->on('users');

            $table->text("story")->nullable();

            $table->string("image_path", 1024)->nullable();

            $table->unsignedBigInteger('town_id')->nullable();
            $table->foreign('town_id')->references('id')->on('towns');
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
        Schema::dropIfExists('maths');
    }
}
