<?php

namespace App\Transformer\StudentERD;

class StudentTransformer
{
    public function transform($task)
    {
        return [
            'id' => $task->id,
            'name' => $task->name,
            'birthday' => $task->birthday,
            'registerDate' => $task->registerDate,
            'remark' => $task->remark
        ];
    }
}
