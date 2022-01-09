<?php

class WorkoutPlan extends Model{


function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(isset($data['id']) && !(is_null($data['id'])) ){
            $this->id=$data['id'];
        }else{
            $this->create($data['create_data']);
            $this->id = $this->helper_factory->getHelper("WorkoutPlan")->getLatestPlanId($data['create_data']['Coach_Email']);   
        }
    }
}   


//Creates a workout plan
function create($data){
    $this->db->insert("Plan_details",$data,"sss");
}


//Returns created coach for the plan
function getCreatedCoach(){
    return $this->db->select("Plan_details",array("Coach_Email"),array("Plan_id"=>$this->id),1)['Coach_Email'];
}


//Returns registered customers for this plan
function getCustomersForPlan(){
    $customer_arr = array();
    foreach($this->db->select("Plan_Registration",array("Customer"),array("Plan_id"=>$this->id)) as $row)
        $customer_arr[] = $row['Customer'];
    return $customer_arr;
}


//Adds/registers customers for this plan
function addCustomers($customer_array){
    foreach($customer_array as $customer)
        $this->addCustomer($customer);
}


//Adds/registers customer for this plan
function addCustomer($customer){
    $this->db->insert("plan_registration",array("Plan_id"=>$this->id,"Customer"=>$customer),'ds');
}


/////////////////////Helper Functions////////////////////////////

//Get the latest sent message
function getLatestPlanId($coach_email){
    return $this->helper_factory->getHelper("WorkoutPlan")->getLatestPlanId($coach_email);
}


//Returns all plans created by a coach
function getAllPlansForACoach($coach_email){
    return $this->helper_factory->getHelper("WorkoutPlan")->getAllPlansForACoach($coach_email);
}


//Returns all plans for a customer
function getAllPlansForACustomer($customer_email){
    return $this->helper_factory->getHelper("WorkoutPlan")->getAllPlansForACustomer($customer_email);
}


//Returns data of given plan
function getPlan($plan_id){
    return $this->helper_factory->getHelper("WorkoutPlan")->getPlan($plan_id);
}


//Get the latest created session by givem coach
function getLatestCreatedPlan($coach){
    return $this->helper_factory->getHelper("WorkoutPlan")->getLatestCreatedPlan($coach);
}


//Returns the registered customers for the given coach email
function registeredCustomersForCoach($email){
    return $this->helper_factory->getHelper("Coach_Registration")->registeredCustomers($email);
}




}
?>