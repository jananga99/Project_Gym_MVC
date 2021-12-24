<?php

class Auth_Model extends Model{

function __construct(){
    parent::__construct();
}

function getData(){
    print_r($this->db->select("Customer"));
}

function validateLogIn($type,$email,$password){
    return $this->db->select($type,array("Email"),array("Email"=>$email,"password"=>sha1($password)),1,0,0,"ss");
}

function validateSignup($email){
    foreach(array("Customer","Coach","Admin") as $type){
        if($this->db->select($type,array("Email"),array("Email"=>$email),1,0,0,"s"))
            return FALSE;
    }
    return TRUE;
}

function signup($type,$arr){
    if($type==="Customer")
        $this->db->insert($type,array("LastName"=>$arr['lname'], "FirstName"=>$arr['fname'], "Age"=>$arr['age'], "Gender"=>$arr['gender'], "Telephone"=>$arr['tel'], "email"=>$arr['email'], "password"=>sha1($arr['password'])),"ssdssss");
    else
        $this->db->insert($type,array("LastName"=>$arr['lname'], "FirstName"=>$arr['fname'], "Age"=>$arr['age'], "Gender"=>$arr['gender'],"City"=>$arr['city'], "Telephone"=>$arr['tel'], "email"=>$arr['email'], "password"=>sha1($arr['password'])),"ssdsssss");
    return;
}

}





?>