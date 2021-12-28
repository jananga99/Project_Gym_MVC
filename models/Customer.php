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


//Returns details of the given customer_email
static function getCustomerData($customer_email){
    return self::$dbStatic->select("Customer",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", 
    ),array("Email"=>$customer_email,"Delected"=>'0'),1);
}


//Returns all coach data
static function getAllCustomerData($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    return self::$dbStatic->select("Customer",$fields,$sort_arr,0,$orderField,$reverse);
}


//Returns all registered customer data 
function getRegisteredCoachesData(){
    $coach_Registration = new Coach_Registration();
    $coach_arr = array();
    Coach::setDatabase();
    foreach( $coach_Registration->registeredCoaches($this->email) as $row ) 
        $coach_arr[] = Coach::getCoachData($row['Coach']);
    return $coach_arr;    
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




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