<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Student;
use App\Repositories\StudentRepository;
use Illuminate\Support\Collection;

class StudentGetTest extends TestCase
{
     use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testStudentModel()
    {
        /** arrange */
        factory(Student::class, 100)->create();
        $target = App::make(StudentRepository::class);
        $expected = new Collection([
            100,
            99,
            98,
        ]);

        /** act */
        $actual = $target->getLatest3Posts()->pluck('id');

        /** assert */
        $this->assertEquals($expected, $actual);
    }

    public function testStudentGetResponse()
    {
        factory(Student::class, 10)->create();
        $parameters = '3';

        $response = $this->call('GET', 'api/v1/students/' . $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentConditionsGetResponse()
    {
        factory(Student::class, 10)->create([
            'registerDate' => '1995-03-27'
        ]);
        $parameters = ['register_date' => '1995-03-27'];

        $response = $this->call('POST', 'api/v1/students/method/query', $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($json));
    }

    public function testStudentNumberLimitResponse()
    {
        factory(Student::class, 10)->create();
        $startNumber = '3';
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
        factory(Student::class, 10)->create();
        $student_id = '3';
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
