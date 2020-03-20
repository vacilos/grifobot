<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToMaths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maths', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('creator_user_id')->default(1)->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('updater_user_id')->default(1)->nullable();
            $table->foreign('updater_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maths', function (Blueprint $table) {
            //
        });
    }
}
