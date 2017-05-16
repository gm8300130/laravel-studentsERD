<?php
namespace App\Http\Controllers;

use Request;
use Input;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Repositories\StudentCourseGradeRepository;
use App\Repositories\StudentRepository;
use App\Transformer\StudentERD\StudentCourseGradeTransformer;
use App\Transformer\StudentERD\StudentTransformer;
use App\Transformer\StudentERD\GradesCourseOfStudentTransformer;

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
        $student_course_grade = new StudentCourseGradeRepository();
        
        return $this->response
        ->withCollection($student_course_grade->data->get(),
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
    #TODO 用token 取代 timestamp, PUT 可以寫在這裡 
    public function createStudent(Request $request)
    {
        $student_data = $request::only([
        'id',
        'name',
        'birthday',
        'register_date',
        'remark',
        'timestamp'
        ]);
        
        $StudentRepository = new StudentRepository;
        $student = $StudentRepository->createStudent($student_data);
        
        if ($student) {
            return $this->response->withItem($student, new  StudentTransformer());
        } else {
            return $this->response->errorForbidden('Could not created a student');
        }
    }
    
    public function gradesCourseOfStudent()
    {
        $student_course_grade = new StudentCourseGradeRepository();
        
        $grades_course_of_student = $student_course_grade
        ->gradesCourseOfStudent()
        ->get();
        
        if ($grades_course_of_student->isEmpty()) {
            return $this->response->errorForbidden();
        }
        
        return $this->response
        ->withCollection($grades_course_of_student,
        new GradesCourseOfStudentTransformer());
    }
    
}