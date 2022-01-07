<?php

abstract class User extends Model{
    
protected $email;
protected $messageMediator;
protected $type;

function __construct($type,$email,$mediator=0){
    parent::__construct();
    $this->messageMediator = $mediator;   
    $this->email=$email ; 
    $this->type = $type;
}


//Inserts given user details to database
static function create($user_type,$data,$data_types){
    $this->db->insert($user_type,$data,$data_types);
}

//Edits User data in database
function edit($data,$dataTypes){
    $this->db->update($this->type,$data,array("Email"=>$this->email),$dataTypes);
}


//Returns details for this User
function getData(){
    return $this->db->select($this->type,0,array("Email"=>$this->email),1);
}


//Returns details for this User
function getEmail(){
    return $this->email;
}


//Returns true if email is unique from all previous users, false otherwise
static function isEmailunique($email){
    foreach(array("Customer","Coach","Admin") as $type){
        if($this->db->select($type,array("Email"),array("Email"=>$email),1,0,0,"s"))
            return FALSE;
    }
    return TRUE;        
}


//Mediator

//Returns Message mediator for this function
function getMessageMediator(){
    return $this->messageMediator;
}


//Sends message using mediator
function sendMessage($message){      
    $this->messageMediator->sendMessage($message,$this);
}


}