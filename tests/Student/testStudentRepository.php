<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


use App\Repositories\StudentRepository;
use App\Student;
# TODO:使用 SQLite In-Memory 方式比較好
class testStudentRepositories extends TestCase
{
    public function testGetStudent()
    {
        $studentId = 952;

        /** arrange */
        $target = App::make(StudentRepository::class);
        $expected = [
                    'id' => 952,
                    'name' => 'Ms. Abbey McClure DDS',
                    'birthday' => '1988-01-04',
                    'registerDate' => '1978-04-28',
                    'remark' => 'In fuga optio blanditiis. Alias odio voluptatem aut et officiis.'
                    ];

        /** act */
        $student = $target->getStudent($studentId)->first();
        $actual = [
            'id' => $student['id'],
            'name' => $student['name'],
            'birthday' => $student['birthday'],
            'registerDate' => $student['registerDate'],
            'remark' => $student['remark']
            ];
        /** assert */
        $this->assertEquals($expected, $actual);
    }

    public function testGetStudentConditionsData()
    {
        $parameters = [
            'id' => null,
            'name' => null,
            'register_date' => '1972-07-04',
            'timestamp' => 0
            ];

        /** arrange */
        $target = App::make(StudentRepository::class);
        $expected = [0 =>
                        [
                        'id' => 970,
                        'name' => 'Alberto Ledner',
                        'birthday' => '2006-12-19',
                        'registerDate' => '1972-07-04',
                        'remark' => 'Fugit et perspiciatis quis est numquam nemo dignissimos.',
                        'timestamp' => 0
                        ],
                    1 =>[
                        'id' => 992,
                        'name' => 'Dr. Consuelo Reichel',
                        'birthday' => '1971-05-16',
                        'registerDate' => '1972-07-04',
                        'remark' => 'Aperiam expedita quis non suscipit hic eligendi.',
                        'timestamp' => 0
                        ]
                    ];

        /** act */
        $student = $target->getStudentConditionsData($parameters);
        $actual = $student->toArray();
        /** assert */
        $this->assertEquals($expected, $actual);
    }

    public function testGetStudentIntervalData()
    {
        $start_number = '952';
        $limit = '2';

        /** arrange */
        $target = App::make(StudentRepository::class);
        $expected = [0 =>
                        [
                        'id' => 952,
                        'name' => 'Ms. Abbey McClure DDS',
                        'birthday' => '1988-01-04',
                        'registerDate' => '1978-04-28',
                        'remark' => 'In fuga optio blanditiis. Alias odio voluptatem aut et officiis.',
                        'timestamp' => 0
                        ],
                    1 =>[
                        'id' => 953,
                        'name' => 'Elda Wolf I',
                        'birthday' => '2003-01-20',
                        'registerDate' => '1999-11-09',
                        'remark' => 'Ea id quae aut autem veniam amet voluptate. Et illo voluptas odit quis eaque.',
                        'timestamp' => 0
                        ]
                    ];

        /** act */
        $student = $target->getStudentIntervalData($start_number, $limit);
        $actual = $student->toArray();
        //dd($actual);
        /** assert */
        $this->assertEquals($expected, $actual);
    }

    public function testCreateStudent()
    {
        $parameters = [
            'name' => 'Alberto Ledner',
            'birthday' => '1966-10-11',
            'register_date' => '1982-07-04',
            'remark' => 'happy gay',
            'timestamp' => time()
            ];

        $target = App::make(StudentRepository::class);
        
        /** arrange */
        $expected = Student::all()->count() + 1;
        /** act */
        $actual = $target->CreateStudent($parameters);
        $actual = $actual->count();
        /** assert */
        $this->assertEquals($expected, $actual);
    }

}

