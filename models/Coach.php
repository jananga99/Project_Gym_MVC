<?php

class Coach extends User implements Observer{

function __construct($email,$mediator=0){
    parent::__construct("Coach",$email,$mediator);
}


//Returns details of the given coach_email
static function getCoachData($coach_email){
    return self::$dbStatic->select("Coach",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", 
    "City"),array("Email"=>$coach_email,"Delected"=>'0'),1);
}


//Returns all coach data
static function getAllCoachData($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    return self::$dbStatic->select("Coach",$fields,$sort_arr,0,$orderField,$reverse);
}


//Returns all customer data
static function getAllCoaches($sort_arr=0,$orderField=0,$reverse=0){
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    $coach_arr = array();
    foreach(self::$dbStatic->select("Coach",array("Email"),$sort_arr,0,$orderField,$reverse) as $row){
        $coach_arr[] = $row['Email'];
    }
    return $coach_arr;
}


//Returns all registered customer data 
function getRegisteredCustomersData(){
    $coach_Registration = new Coach_Registration();
    $customer_arr = array();
    Customer::setDatabase();
    foreach( $coach_Registration->registeredCustomers($this->email) as $row ) 
        $customer_arr[] = Customer::getCustomerData($row['Customer']);
    return $customer_arr;    
}


//Observer
public function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Coach","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
