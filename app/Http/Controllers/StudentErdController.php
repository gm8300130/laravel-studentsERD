<?php
namespace App\Http\Controllers;

use Request;
use Input;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Repositories\StudentCourseGradeRepository;
use App\Repositories\StudentRepository;
use App\Transformer\StudentERD\StudentCourseGradeTransformer;
use App\Transformer\StudentERD\StudentTransformer;

#TODO Repository, Transformer should be into service
class StudentErdController extends Controller
{
    protected $respose;
    
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
    
    public function queryStudentsCourseGrade()
    {
        $StudentCourseGrade = new StudentCourseGradeRepository();
        
        return $this->response
        ->withCollection($StudentCourseGrade->data->get(),
        new StudentCourseGradeTransformer());
    }
    
    public function queryStudent()
    {
        $student_id = Request::segment(4);
        
        if (!is_numeric($student_id)) {
            return $this->response->errorWrongArgs();
        }
        
        $student = StudentRepository::getStudent($student_id);
        if ($student->isEmpty()) {
            return $this->response->errorForbidden();
        }
        
        return $this->response
        ->withCollection($student, new StudentTransformer());
    }
    
    public function queryStudentConditions()
    {
        if (!Request::isMethod('post')) {
            return $this->response->errorWrongArgs();
        }
        
        $conditions = Request::only(['id', 'name', 'register_date', 'start']);
        $student = StudentRepository::getStudentConditionsData($conditions);
        
        if ($student->isEmpty()) {
            return $this->response->errorForbidden();
        }
        
        return $this->response
        ->withCollection($student, new StudentTransformer());
    }
    
    public function queryStudentNumberLimit($startRowNumber, $limit)
    {
        $student = StudentRepository::getStudentIntervalData($startRowNumber, $limit);
        
        if ($student->isEmpty()) {
            return $this->response->errorForbidden();
        }
        
        return $this->response
        ->withCollection($student, new StudentTransformer());
    }
}
