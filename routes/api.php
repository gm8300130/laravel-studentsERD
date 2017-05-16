<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/v1/students/students_course_grade', 'StudentErdController@queryStudentsCourseGrade');

Route::get('/v1/students/{studentId}', 'StudentErdController@queryStudent');

Route::post('/v1/students/method/query', 'StudentErdController@queryStudentConditions');

Route::any('/v1/students/method/start/{startRowNumber}/limit/{limit}', 'StudentErdController@queryStudentNumberLimit')
->where('startRowNumber', '[0-9]+')
->where('limit', '[0-9]+');

Route::any('/v1/students/method/create', 'StudentErdController@createStudent');

Route::get('/v1/students/grades/Course_of_Student', 'StudentErdController@gradesCourseOfStudent');
