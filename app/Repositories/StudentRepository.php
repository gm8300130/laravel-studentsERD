<?php namespace App\Repositories;

use App\Student;

class StudentRepository
{
    protected $student;
    
    public function __construct()
    {
        $student = new Student;
        $this->student = $student;
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
    
    public function createStudent($student_data)
    {
        try {
            $token = $this->student::where('timestamp', $student_data['timestamp'])->get();
            
            if (!$token->isEmpty()) {
                return false;
            }
            
            $this->student->name = $student_data['name'];
            $this->student->birthday = $student_data['birthday'];
            $this->student->registerDate = $student_data['register_date'];
            $this->student->remark = $student_data['remark'];
            $this->student->timestamp = $student_data['timestamp'];
            $this->student->save();
        
            return $this->student;
        } catch (\Exception $e) {
            return $e->message();
        }
    }
}
