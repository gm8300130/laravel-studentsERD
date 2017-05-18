<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\StudentCourseGradeRepository;
use App\StudentCourseGrade;

# TODO:使用 SQLite In-Memory 方式比較好
class testStudentCourseGradeRepository extends TestCase
{
    public function testGradesCourseOfStudent()
    {

        $target = App::make(StudentCourseGradeRepository::class);
        
        /** arrange */
        $expected = 35;
        /** act */
        $actual = $target->gradesCourseOfStudent();
        $actual = $actual->get()->count();
        /** assert */
        $this->assertEquals($expected, $actual);
    }
}
