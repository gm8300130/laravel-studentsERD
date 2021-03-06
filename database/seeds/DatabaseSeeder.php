<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $this->call('StudentTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('GradeTableSeeder');
        $this->call('StudentCourseGradeTableSeeder');
    }
}