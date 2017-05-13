<?php

use Illuminate\Database\Seeder;
use App\Grade;

class GradeTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('grade')->delete();
        $grade = array('A', 'B', 'C', 'D');
        
        for ($i=0; $i < 4; $i++) {
            Grade::create([
                'level' => $grade[$i],
                'remark' =>$grade[$i]
            ]);
        }
    }
}