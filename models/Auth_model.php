<?php

class Auth_Model extends Model{

function __construct(){
    parent::__construct();
}

function getData(){
    print_r($this->db->select("Customer"));
}

function validateLogIn($type,$email,$password){
    return $this->db->select("Customer",array("Email"),array("Email"=>$email,"password"=>sha1($password)),1,0,0,"ss");
}


}





?>