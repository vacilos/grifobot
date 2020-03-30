<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnswersToMathsTable extends Migration
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
            $table->string('answer_alt1')->nullable()->default(null);
            $table->string('answer_alt2')->nullable()->default(null);
            $table->string('answer_alt3')->nullable()->default(null);
            $table->string('answer_alt4')->nullable()->default(null);
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
