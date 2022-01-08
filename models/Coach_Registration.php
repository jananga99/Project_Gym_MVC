<?php

class Coach_Registration extends Model{

function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(!is_null($data['id'])){
            $this->id=$data['id'];
        }else{
            $this->register($data['create_data']['customer_email'],$data['create_data']['coach_email']);
            $this->id =  $this->helper_factory->getHelper("Coach_Registration")->getRegistrationId($data['create_data']['customer_email'],$data['create_data']['coach_email']);   
        }
    }
}


//Inserts given user details to database
function register($customer_email,$coach_email){
    $this->db->insert("coach_registration",array("Customer"=>$customer_email, "Coach"=>$coach_email),"ss");
}


//Deletes a registration (unregister)
function unregister(){
    $this->db->update("coach_registration",array("Delected"=>'1'),array("Registration_id"=>$this->id),'d');    
}


/////////Helper Functions///////////////

//Get the latest sent message
function getRegistrationId($customer,$coach){
    return $this->helper_factory->getHelper("Coach_Registration")->getRegistrationId($customer,$coach);
}


//Returns True if given customer is registered for coach
function isCoachRegistered($customer,$coach){
    return $this->helper_factory->getHelper("Coach_Registration")->isCoachRegistered($customer,$coach);
}


//Returns the registered coaches for the given customer email
function registeredCoaches($email){
    return $this->helper_factory->getHelper("Coach_Registration")->registeredCoaches($email);
}


//Returns all registered coaches data 
function getRegisteredCoachesData($customer_email){
    return $this->helper_factory->getHelper("Coach_Registration")->getRegisteredCoachesData($customer_email); 
}


//Returns all registered customer data 
function getRegisteredCustomersData($email){
    return $this->helper_factory->getHelper("Coach_Registration")->getRegisteredCustomersData($email);    
}


//Returns the registered customers for the given coach email
function registeredCustomers($email){
    return $this->helper_factory->getHelper("Coach_Registration")->registeredCustomers($email) ;
}


}
?>