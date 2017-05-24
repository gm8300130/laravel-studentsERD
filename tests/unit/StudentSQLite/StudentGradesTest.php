<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentGradesTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();
        // 最好針對需要測試的在建立
        Artisan::call('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testStudentGradesCourseOfStudentResponse()
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
