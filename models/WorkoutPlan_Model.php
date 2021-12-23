<?php

class WorkoutPlan_Model extends Model{


function __construct(){
    parent::__construct();
}   

function getAllPlansForACoach($coach_email){
    return $this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan"),array("Coach_Email"=>$coach_email));
}

function getAllPlansForACustomer($customer_email){
    $plan_id_arr = $this->db->select("Plan_Registration",array("Plan_id"),array("Customer_Email"=>$customer_email));
    $plan_arr = array();
    foreach($plan_id_arr as $pia){
        $plan_arr[] = $this->db->select("Plan_details",array("Plan_id","Plan_Name","Coach_Email","Plan"),array("Plan_id"=>$pia));
    }
    return $plan_arr;
}

function getPlan($plan_id){
    return $this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan","Customer_Email"),array("Plan_id"=>$plan_id),1);
}

function getCoachForPlan($plan_id){
    return $this->db->select("Plan_details",array("Coach_Email"),array("Plan_id"=>$plan_id),1)['Coach_Email'];
}

function getCustomersForPlan($plan_id){
    return $this->db->select("Plan_Registration",array("Customer_Email"),array("Plan_id"=>$plan_id));
}

function create($coach_email,$data){
    $this->db->insert("Plan_details",array("Plan"=>$data['plan'],"Plan_Name"=>$data['plan_name'],"Coach_email"=>$coach_email),"sss");
}

//TODO : CHANGE THIS
function getRegisterCustomersForCoach($coach){
    return $this->db->select("Registration",array("Customer"),array("Coach"=>$coach));
}

function addCustomers($plan_id,$customer_array){
    foreach($customer_array as $customer){
        $this->db->insert("plan_registration",array("Plan_id"=>$plan_id,"Customer_Email"=>$customer));
    }
}

//Get the latest created session by logged in coach
//TODO
function getLatestCreatedPlan($coach){
    return $this->db->select("Plan_details",array("Plan_id"),array("Coach_Email"=>$coach),1,"Plan_id",1)['Plan_id'];
}

}
?>