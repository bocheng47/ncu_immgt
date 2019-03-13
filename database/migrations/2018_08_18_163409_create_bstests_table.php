<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBstestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bstests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('weight')->nullable();
            $table->integer('order')->nullable();
            $table->string('year')->nullable();
            $table->float('grade')->nullable();
            $table->string('num')->nullable();
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
        Schema::dropIfExists('bstests');
    }
}
