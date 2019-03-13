<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsapplyTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsapply-text', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->nullable();
            $table->integer('quota')->nullable();
            $table->integer('num')->nullable();
            $table->string('rate')->nullable();
            $table->integer('year2')->nullable();
            $table->integer('low')->nullable();  
            $table->integer('high')->nullable();          
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
        Schema::dropIfExists('bsapply-text');
    }
}
