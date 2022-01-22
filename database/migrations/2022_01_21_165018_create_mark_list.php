<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_list', function (Blueprint $table) {
            $table->bigIncrements('marklist_id');
            $table->unsignedBigInteger('student_id');
            $table->string('term',15);
            $table->integer('maths');
            $table->integer('science');
            $table->integer('history');
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mark_list');
    }
}
