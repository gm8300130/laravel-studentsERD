<?php

namespace App\Transformer\StudentERD;

class GradesCourseOfStudentTransformer
{
    public function transform($task)
    {
        return [
            'level' => $task->gradelevel,
            'course' => $task->course->name,
            'count' => $task->count
        ];
    }
}