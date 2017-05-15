<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    
    public $timestamps = false;
    
    public function scopeOfStudentId($query, $student_id = null)
    {
        return $student_id ? $query->where('id', $student_id) : null;
    }
    
    public function scopeOfRegisterDate($query, $register_date = null)
    {
        return $register_date ? $query->where('registerDate', $register_date) : null;
    }
    
    public function scopeOfName($query, $name = null)
    {
        return $name ? $query->where('name', $name) : null;
    }
    
    public function scopeOfStudentIdStartLimit($query, $startRowNumber, $limit = 0)
    {
        return  $query->where('id', '>=', $startRowNumber)
            ->take($limit);
    }
    
}