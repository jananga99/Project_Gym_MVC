<?php

class Coach extends Model implements Observer{

function __construct($email,$mediator=0){
    parent::__construct();
    $this->messageMediator = $mediator;    //TODO   
    $this->email=$email; 
}


//Edits Customer data in database
function edit($data,$dataTypes){
    $this->db->update("Coach",$data,array("Email"=>$this->email),$dataTypes);
}


//Returns details for this cutomer
function getData(){
    return $this->db->select("Coach",0,array("Email"=>$this->email),1);
}




function getAllData($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    return $this->db->select("Coach",$fields,$sort_arr,0,$orderField,$reverse);
}

//Observer
public function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Coach","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}

//Mediator
function sendMessage($data){       //TODO     
    $this->messageMediator->sendMessage($data,$this);
}


}
