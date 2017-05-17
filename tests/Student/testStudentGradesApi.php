<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestStudentGradesApi extends TestCase
{
    public function testStudentGradesCourseOfStudentResopnse()
    {
        $response = $this->call('GET', 'api/v1/students/grades/Course_of_Student');

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentGradesCourseOfStudentJson()
    {
        $jsonformat =
            ['*' =>
                ['*'=>[
                    'level',
                    'course',
                    'count',
                    ]
                ]
            ];

        $this->get('api/v1/students/grades/Course_of_Student')
            ->seeJsonStructure($jsonformat);
    }
}
