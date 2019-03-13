<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsstarTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsstar-text', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->integer('quota');
            $table->integer('num');
            $table->string('rate');
            $table->integer('low');  
            $table->integer('high');
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
        Schema::dropIfExists('bsstar-text');
    }
}
