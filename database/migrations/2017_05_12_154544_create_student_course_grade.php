<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCourseGrade extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('student_course_grade', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('studentId');
            $table->integer('courseId');
            $table->char('gradelevel', 1)->nullable();
            
            $table->primary(array('courseId', 'studentId'));
        });
        
        Schema::table('student_course_grade', function ($table) {
            $table->foreign('studentId')->references('id')->on('student');
            $table->foreign('courseId')->references('id')->on('course');
            $table->foreign('gradelevel')->references('level')->on('grade')->onDelete('set null');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('student_course_grade');
    }
}