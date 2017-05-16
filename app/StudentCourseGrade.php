<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourseGrade extends Model
{
    protected $table = 'student_course_grade';
    public $timestamps = false;
    
    public function students()
    {
        return $this->hasone('App\Student', 'id', 'studentId');
    }
    
    public function course()
    {
        return $this->hasone('App\Course', 'id', 'courseId');
    }
    
    public function grade()
    {
        return $this->hasone('App\Grade', 'level', 'gradelevel');
    }
    
}