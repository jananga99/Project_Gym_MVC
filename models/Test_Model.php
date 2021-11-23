<?php

class Test_Model extends Model{

function __construct(){
    parent::__construct();
}

function getData(){
    print_r($this->db->select("Customer"));
}



}





?>