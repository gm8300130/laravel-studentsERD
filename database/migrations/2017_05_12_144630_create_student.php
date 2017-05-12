<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudent extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('student', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->comment('流水號');
            $table->string('name', 60)->comment('學生中文全名');
            $table->date('birthday')->comment('學生出生年月日');
            $table->date('registerDate')->comment('學生註冊日期');
            $table->string('remark', 100)->nullable()->comment('備註');
            
            $table->primary('id');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('student');
    }
}