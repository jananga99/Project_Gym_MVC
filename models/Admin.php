<?php

class Admin extends Model{

function __construct($email,$mediator=0){
    parent::__construct();
    $this->email = $email;
    $this->messageMediator = $mediator;    //TODO    
}

//Edits Customer data in database
function edit($data,$dataTypes){
    $this->db->update("Admin",$data,array("Email"=>$this->email),$dataTypes);
}


//Returns details for this cutomer
function getData(){
    return $this->db->select("Admin",0,array("Email"=>$this->email),1);
}


//Returns details for this cutomer
function getEmail(){
    return $this->email;
}











}
?>