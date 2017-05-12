<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrade extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('grade', function ($table) {
            $table->engine = 'InnoDB';
            $table->char('level', 1)->nullable()->comment('評等，如：A, B, C, D');
            $table->string('remark', 100)->nullable()->comment('備註');
            
            $table->primary('level');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('grade');
    }
}