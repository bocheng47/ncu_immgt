<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('class1')->nullable();
            $table->string('class2')->nullable();
            $table->string('class3')->nullable();
            $table->string('class4')->nullable();
            $table->string('hreftocollege')->nullable();
            $table->string('hreftoms')->nullable();
            $table->string('hreftophd')->nullable();
            $table->string('hreftoemba')->nullable();
            $table->string('href')->nullable();
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
        Schema::dropIfExists('questionnaire');
    }
}
