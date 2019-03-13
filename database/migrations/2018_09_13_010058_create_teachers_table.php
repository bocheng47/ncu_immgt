<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('awards')->nullable();
            $table->string('email')->nullable();
            $table->string('office')->nullable();
            $table->string('number')->nullable();
            $table->string('title')->nullable();
            $table->string('leader')->nullable();
            $table->string('gp')->nullable();
            $table->string('position')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('pic_type')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
