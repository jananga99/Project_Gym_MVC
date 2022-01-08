<?php
require_once 'models/User.php';
class Customer extends User{

function __construct($data=-1){
    parent::__construct("Customer",$data);
}


//Observer
function update($data){
    $factory = new Factory();
    $data1=array();
    $data1['create_data'] = array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']);
    $data1['create_data_types'] = 'ssss';
    $factory->getModel("Notification",$data1);
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}


//////////////////Helper Functions

//Returns details of the given customer_email
function getCustomerData($customer_email){
    return $this->helper_factory->getHelper("Customer")->getCustomerData($customer_email); 
}


//Returns all coach data
function getAllCustomerData($sort_arr=0,$orderField=0,$reverse=0){
    return $this->helper_factory->getHelper("Customer")->getAllCustomerData($sort_arr,$orderField,$reverse);
}


//Returns all customer data
function getAllCustomers($sort_arr=0,$orderField=0,$reverse=0){
    return $this->helper_factory->getHelper("Customer")->getAllCustomers($sort_arr,$orderField,$reverse);
}

//Returns all registered coaches data 
function getRegisteredCoachesData($customer_email){
    return $this->helper_factory->getHelper("Coach_Registration")->getRegisteredCoachesData($customer_email); 
}


}
?>