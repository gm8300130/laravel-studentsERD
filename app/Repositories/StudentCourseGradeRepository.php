<?php namespace App\Repositories;

use App\StudentCourseGrade;

class StudentCourseGradeRepository
{   
    public function __construct()
    {
        $this->data = StudentCourseGrade::with('students',
        'course',
        'grade');
    }
    
    public function gradesCourseOfStudent()
    {
        return $this->data
        ->selectRaw(' count(`studentId`) as count, `courseId`, `gradelevel` ')
        ->groupBy('courseId')
        ->groupBy('gradelevel');
    }
}