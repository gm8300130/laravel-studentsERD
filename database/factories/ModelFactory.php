<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Student::class, function (Faker\Generator $faker) {
    
    return [
        'name' => $faker->name,
        'birthday' => $faker->date,
        'registerDate' => $faker->date,
        'remark' => $faker->text(80) ,
        'timestamp' => time(),
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    
    return [
        'name' => $faker->name,
        'createDate' => $faker->date,
        'remark' => $faker->text(80),
    ];
});

$factory->define(App\StudentCourseGrade::class, function (Faker\Generator $faker) {
    
    $studentId = App\Student::pluck('id')->toArray();
    $courseId = App\Course::pluck('id')->toArray();
    $gradelevel = App\Grade::pluck('level')->toArray();
    
    return [
        'studentId' => $faker->randomElement($studentId),
        'courseId' => $faker->randomElement($courseId),
        'gradelevel' => $faker->randomElement($gradelevel),
    ];
});