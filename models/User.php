<?php

abstract class User extends Model{
    
protected $email;
protected $messageMediator;
protected $type;
protected $id;

function __construct($type,$email,$mediator=0){
    parent::__construct();
    $this->messageMediator = $mediator;   
    $this->email=$email ; 
    $this->type = $type;
    $this->id = self::getIdForEmail($type,$email);
}


//Inserts given user details to database
static function create($user_type,$data,$data_types){
    self::$dbStatic->insert($user_type,$data,$data_types);
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


//Returns Email for this User_id
static function getEmailForId($type,$id){
    return self::$dbStatic->select($type,array("Email"),array($type."_id"=>$id),1)['Email'];
}


//Returns User_id for this Email
static function getIdForEmail($type,$email){
    return  self::$dbStatic->select($type,array($type."_id"),array("Email"=>$email),1)[$type."_id"];
}


//Returns true if email is unique from all previous users, false otherwise
static function isEmailunique($email){
    foreach(array("Customer","Coach","Admin") as $type){
        if(self::$dbStatic->select($type,array("Email"),array("Email"=>$email),1,0,0,"s"))
            return FALSE;
    }
    return TRUE;        
}


}