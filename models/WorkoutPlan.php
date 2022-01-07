<?php

class WorkoutPlan extends Model{


function __construct($id){
    parent::__construct();
    $this->id = $id;
}   


//Returns data of this plan
function getData(){
    $workoutPlan_helper = new WorkoutPlan_Helper();
    return $workoutPlan_helper->getPlan($this->id);
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


}
?>