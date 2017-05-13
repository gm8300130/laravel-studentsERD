<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('student')->delete();
        factory(App\Student::class, 50)->create();
    }
}