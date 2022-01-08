<?php

abstract class User extends Model{
    
protected $email;
protected $messageMediator;
protected $type;

function __construct($type,$data){
    parent::__construct();
    $this->type = $type;
    if($data!=-1){
        if(!is_null($data['id'])){
            $this->email=$data['id'];
        }else{
            $this->create($data['create_data'],$data['create_data_types']);
            $this->email = $data['create_data']['Email'];   
        }
        if(isset($data['mediator']))
            $this->messageMediator = $data['mediator'];  
    } 
}


//Inserts given user details to database
function create($data,$data_types){
    $this->db->insert($this->type,$data,$data_types);
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


//Mediator

//Returns Message mediator for this function
function getMessageMediator(){
    return $this->messageMediator;
}


//Sends message using mediator
function sendMessage($message){      
    $this->messageMediator->sendMessage($message,$this);
}


///////////////////Helper Functions///////////////////

//Returns true if email is unique from all previous users, false otherwise
function isEmailunique($email){
    return $this->helper_factory->getHelper($this->type)->isEmailunique($email);      
}


}