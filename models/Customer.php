<?php

class Customer extends Model{
    
private $email;

function __construct($email,$mediator=0){
    parent::__construct();
    $this->messageMediator = $mediator;    //TODO
    $this->email=$email ; 
}

//Edits Customer data in database
function edit($data,$dataTypes){
    $this->db->update("Customer",$data,array("Email"=>$this->email),$dataTypes);
}

//Returns details for this cutomer
function getData(){
    return $this->db->select("Customer",0,array("Email"=>$this->email),1);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




function searchCoach($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    return $this->db->select("Coach",$fields,$sort_arr,0,$orderField,$reverse);
}

function viewCoach($email){
    return $this->db->select("Coach",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", "City"),array("Email"=>$email),1);
}

function addCoach($customer,$coach){
    $this->db->insert("Registration",array("Customer"=>$customer, "Coach"=>$coach),"ss");
}

function isCoachRegistered($customer,$coach){
    if($this->db->select("Registration",array("Customer","Coach"),array("Customer"=>$customer,
    "Coach"=>$coach),1))
        return True;
    else
        return False;    
}

function registeredCoaches($email){
    $coach_arr = array();
    foreach( $this->db->select("Registration",array("Coach"),array("Customer"=>$email)) as $row ) {
        $coach_arr[] = $this->viewCoach($row['Coach']);
    }
    return $coach_arr;
}

//Observer
function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}

//Mediator
function receieveMessage($data){       //TODO
    $this->db->insert("messages",array("Receiver_Email"=>$this->email,"Sender_Email"=>$data['send_email'],"Details"=>$data['details']),'sss');    
}



}
?>