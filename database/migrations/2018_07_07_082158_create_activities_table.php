<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activityname');
            $table->text('introduce')->nullable();
            $table->date('time')->nullable();
            $table->tinyInteger('class');
            $table->string('picture');
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
        Schema::dropIfExists('activities');
    }
}
