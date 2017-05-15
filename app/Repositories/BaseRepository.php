<?php namespace App\Repositories;

class BaseRepository
{
    public $result = [];
    public $user_id = '';
    public $timestamp = '';

    public function __construct() {

    }

    public function merge($data){
        $this->result = array_merge($data, $this->result);
        return $this;
    }

    public function output() {
        return $this->result;
    }
}
