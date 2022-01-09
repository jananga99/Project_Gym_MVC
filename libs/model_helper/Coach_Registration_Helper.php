<?php

class Coach_Registration_Helper extends Helper{

function __construct(){
    parent::__construct();
}


//Get the latest sent message
function getRegistrationId($customer,$coach){
    return $this->db->select("Coach_Registration",array("Registration_id"),array("Customer"=>$customer,"Coach"=>$coach,"Delected"=>'0'),1)['Registration_id'];
}


//Returns True if given customer is registered for coach
function isCoachRegistered($customer,$coach){
    return $this->db->select("coach_registration",array("Registration_id"),array("Customer"=>$customer,"Coach"=>$coach,"Delected"=>0),1)['Registration_id'];  
}


//Returns the registered coaches for the given customer email
function registeredCoaches($email){
    $coach_arr = array();
    foreach ($this->db->select("coach_registration",array("Coach"),array("Customer"=>$email,
    "Delected"=>'0')) as $row) 
        $coach_arr[] = $row['Coach'];
    return  $coach_arr;
}


//Returns all registered coaches data 
function getRegisteredCoachesData($customer_email){
    $coach_arr = array();
    foreach( $this->registeredCoaches($customer_email) as $coach ) 
        $coach_arr[] = $this->helper_factory->getHelper("Coach")->getCoachData($coach);
    return $coach_arr;    
}


//Returns all registered customer data 
function getRegisteredCustomersData($email){
    $factory = new Factory();
    $customer_arr = array();
    foreach(  $this->helper_factory->getHelper("Coach_Registration")->registeredCustomers($email) as $row ) 
        $customer_arr[] =  $this->helper_factory->getHelper("Customer")->getCustomerData($row['Customer']);
    return $customer_arr;    
}


//Returns the registered customers for the given coach email
function registeredCustomers($email){
    return $this->db->select("coach_registration",array("Customer"),array("Coach"=>$email,"Delected"=>'0')) ;
}



}
