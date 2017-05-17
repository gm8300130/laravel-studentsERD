<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

#TODO 測試建立資料須獨立DB, 每次重置都不會被就資料干擾
class TestStudentGetApi extends TestCase
{
    public function testStudentGetResponse()
    {
        $parameters = '953';

        $response = $this->call('GET', 'api/v1/students/' . $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentConditionsGetResponse()
    {
        $parameters = ['register_date' => '1995-03-27'];

        $response = $this->call('POST', 'api/v1/students/method/query', $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentNumberLimitResponse()
    {
        $startNumber = '952';
        $limit = '3';

        $response = $this->call('GET', 'api/v1/students/method/start/'
            . $startNumber. '/limit/' . $limit);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentCreateResponse()
    {
        $parameters = [
                'name' => 'patter',
                'birthday' => '1986-01-21',
                'register_date' => '1995-03-27',
                'remark' => 'hellow world',
                'timestamp' => time()
                ];

        $response = $this->call('POST', 'api/v1/students/method/create', $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    /** StudentErdController
     * @queryStudent
     * @queryStudentConditions
     * @queryStudentNumberLimit
     */
    public function testStudentGetJson()
    {
        $student_id = '953';
        $limit= '3';

        $jsonformat =
            ['*'=>
                ['*'=>[
                    'id',
                    'name',
                    'birthday',
                    'registerDate',
                    'remark'
                    ]
                ]
            ];

        $this->get('api/v1/students/' . $student_id)
            ->seeJsonStructure($jsonformat);
        $this->post('api/v1/students/method/query')
            ->seeJsonStructure($jsonformat);
        $this->post('api/v1/students/method/start/'
            . $student_id. '/limit/' . $limit)
            ->seeJsonStructure($jsonformat);
    }

    public function testStudentCreateJson()
    {
        $parameters = [
                'name' => 'patter',
                'birthday' => '1986-01-23',
                'register_date' => '1995-03-27',
                'remark' => 'hellow world',
                'timestamp' => time() + 10
                ];
        $jsonformat =
                ['*'=>[
                    'id',
                    'name',
                    'birthday',
                    'registerDate',
                    'remark'
                    ]
                ];

        $this->post('api/v1/students/method/create', $parameters)
            ->seeJsonStructure($jsonformat);
    }
}
