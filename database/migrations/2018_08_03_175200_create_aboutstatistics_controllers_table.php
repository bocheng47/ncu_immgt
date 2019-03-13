<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutstatisticsControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutstatistics', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('year');
            $table->string('class')->nullable();
            $table->Integer('menofyearcollege')->nullable();
            $table->Integer('womenofyearcollege')->nullable();
            $table->Integer('totalofyearcollege')->nullable();
            $table->Integer('menofyearms')->nullable();
            $table->Integer('womenofyearms')->nullable();
            $table->Integer('totalofyearms')->nullable();
            $table->Integer('menofyearphd')->nullable();
            $table->Integer('womenofyearphd')->nullable();
            $table->Integer('totalofyearphd')->nullable();
            $table->Integer('menofyearemba')->nullable();
            $table->Integer('womenofyearemba')->nullable();
            $table->Integer('totalofemba')->nullable();
            $table->Integer('totalofcollege')->nullable();
            $table->Integer('totalofms')->nullable();
            $table->Integer('totalofphd')->nullable();
            $table->Integer('total')->nullable();
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
        Schema::dropIfExists('aboutstatistics');
    }
}
