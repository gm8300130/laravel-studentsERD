<?php

use Illuminate\Database\Seeder;

class StudentCourseGradeTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('student_course_grade')->delete();
        factory(App\StudentCourseGrade::class, 100)->create();
    }
}