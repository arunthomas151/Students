<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('student_id');
            $table->string('student_name',100);
            $table->integer('age');
            $table->string('gender',10);
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->foreign('teacher_id')->references('teacher_id')->on('reporting_teacher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
