<?php

namespace App\Transformer\StudentERD;

class StudentCourseGradeTransformer
{
    public function transform($task)
    {
        return [
            'studentId' => $task->studentId,
            'studentName' => $task->students->name,
            'courseId' => $task->courseId,
            'courseName' => $task->course->name,
            'gradelevel' => $task->gradelevel
        ];
    }
}
