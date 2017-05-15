<?php namespace App\Repositories;

use App\StudentCourseGrade;
use App\Transformer\StudentERD\StudentCourseGradeTransformer;

class StudentCourseGradeRepository
{
    public function __construct()
    {
        $this->data =StudentCourseGrade::with(
            'students',
            'course',
            'grade');
    }
}