<?php

class User123 extends Model{
    
function __construct(){
    parent::__construct();                  
}

//Returns true if email is unique from all previous users, false otherwise
function isEmailunique($email){
    foreach(array("Customer","Coach","Admin") as $type){
        if($this->db->select($type,array("Email"),array("Email"=>$email),1,0,0,"s"))
            return FALSE;
    }
    return TRUE;        
}

//Inserts given user details to database
function createUser($user_type,$data,$data_types){
    $this->db->insert($user_type,$data,$data_types);
}





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
?>