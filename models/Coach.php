<?php
require_once 'models/User.php';
class Coach extends User implements Observer{

function __construct($data=-1){
    parent::__construct("Coach",$data);
}


//Observer
public function update($data){
    $data1=array();
    $data1['create_data'] = array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Coach","Notification_Type"=>$data['type'],"Details"=>$data['details']);
    $data1['create_data_types'] = 'ssss';
    $this->factory->getModel("Notification",$data1);
}


////////Helper Functions////////////

//Returns details of the given coach_email
function getCoachData($coach_email){
    return $this->helper_factory->getHelper("Coach")->getCoachData($coach_email);
}


//Returns all coach data
function getAllCoachData($sort_arr=0,$orderField=0,$reverse=0){
    return $this->helper_factory->getHelper("Coach")->getAllCoachData($sort_arr,$orderField,$reverse);
}


//Returns all coaches
function getAllCoaches($sort_arr=0,$orderField=0,$reverse=0){
    return $this->helper_factory->getHelper("Coach")->getAllCoaches($sort_arr,$orderField,$reverse);
}


//Returns all registered customer data 
function getRegisteredCustomersData($email){
    return $this->helper_factory->getHelper("Coach_Registration")->getRegisteredCustomersData($email);    
}


//Returns True if given customer is registered for coach
function isCoachRegisteredForCustomer($customer,$coach){
    return $this->helper_factory->getHelper("Coach_Registration")->isCoachRegistered($customer,$coach);
}


}
