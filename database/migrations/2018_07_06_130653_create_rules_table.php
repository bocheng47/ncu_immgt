<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('acadYear'); // 學年度
            $table->tinyInteger('acadType'); // 0 = 學士, 1 = 碩士, 2 = 博士, 3 = 在職專班
            $table->string('title');
            $table->string('filename');
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
        Schema::dropIfExists('course_rules');
    }
}
