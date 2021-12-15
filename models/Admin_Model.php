<?php

class Admin_Model extends Model{

function __construct(){
    parent::__construct();
}

function getData($email){
    return $this->db->select("Coach",0,array("Email"=>$email),1);
}

function update($email,$data){
    $this->db->update("Coach",
    array("LastName"=>$data['lname'],"FirstName"=>$data['fname'],"Age"=>$data['age'], "City"=>$data['city'],
    "Gender"=>$data['gender'],"Telephone"=>$data['tel']),array("Email"=>$data['email']),'ssdsss');
}













}
?>