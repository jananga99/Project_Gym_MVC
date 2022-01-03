<?php

class Customer extends User{

function __construct($email,$mediator=0){
    parent::__construct("Customer",$email,$mediator);
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


//Returns all customer data
static function getAllCustomers($sort_arr=0,$orderField=0,$reverse=0){
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    $customer_arr = array();
    foreach(self::$dbStatic->select("Customer",array("Email"),$sort_arr,0,$orderField,$reverse) as $row){
        $customer_arr[] = $row['Email'];
    }
    return $customer_arr;
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


//Observer
function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
?>