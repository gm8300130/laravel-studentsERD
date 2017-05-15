<?php namespace App\Repositories;

use App\Student;
use App\Transformer\StudentERD\StudentTransformer;

class StudentRepository
{
    public function __construct()
    {
        parent::__construct();
    }
    
    static public function getStudent($studentId)
    {
        return Student::ofStudentId($studentId)->get();
    }
    
    static function getStudentConditionsData($conditions)
    {
        return StudentRepository::queryOfInputConditions($conditions);
    }
    
    static function getStudentIntervalData($startRowNumber, $limit)
    {
        return Student::ofStudentIdStartLimit($startRowNumber, $limit)
            ->get();
    }
    
    
    static function queryOfInputConditions($conditions)
    {
        return Student::ofStudentId($conditions['id'])
        ->ofName($conditions['name'])
        ->ofRegisterDate($conditions['register_date'])
        ->get();
    }
}