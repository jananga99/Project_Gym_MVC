<?php

class WorkoutPlan extends Model{


function __construct($id){
    parent::__construct();
    $this->id = $id;
}   


//Returns all plans created by a coach
static function getAllPlansForACoach($coach_email){
    return self::$dbStatic->select("Plan_details",array("Plan_id","Plan_Name","Plan"),array("Coach_Email"=>$coach_email,"Delected"=>'0'));
}


//Returns all plans for a customer
static function getAllPlansForACustomer($customer_email){
    $plan_id_arr = $this->db->select("Plan_Registration",array("Plan_id"),array("Customer_Email"=>$customer_email));
    $plan_arr = array();
    foreach($plan_id_arr as $pia)
        $plan_arr[] = $this->db->select("Plan_details",array("Plan_id","Plan_Name","Coach_Email","Plan"),array("Plan_id"=>$pia));
    return $plan_arr;
}


//Returns data of given plan
static function getPlan($plan_id){
    return self::$dbStatic->select("Plan_details",array("Plan_id","Plan_Name","Plan","Customer_Email"),
    array("Plan_id"=>$plan_id),1);
}


//Returns data of this plan
function getData(){
    return $ths->db->select("Plan_details",array("Plan_id","Plan_Name","Plan",
    "Customer_Email"),array("Plan_id"=>$this->id,"Delected"=>'0'),1);
}


//Returns created coach for the plan
function getCreatedCoach(){
    return $this->db->select("Plan_details",array("Coach_Email"),
    array("Plan_id"=>$this->id),1)['Coach_Email'];
}


//Returns registered customers for this plan
function getCustomersForPlan(){
    return $this->db->select("Plan_Registration",array("Customer_Email"),array("Plan_id"=>$this->id));
}


//Creates a workout plan
static function create($coach_email,$data){
    self::$dbStatic->insert("Plan_details",array("Plan"=>$data['plan'],"Plan_Name"=>$data['plan_name'],
    "Coach_email"=>$coach_email),"sss");
}


//Adds/registers customers for this plan
function addCustomers($customer_array){
    foreach($customer_array as $customer)
        $this->db->insert("plan_registration",array("Plan_id"=>$this->id,"Customer_Email"=>$customer));
}

//Get the latest created session by givem coach
static function getLatestCreatedPlan($coach){
    return $this->db->select("Plan_details",array("Plan_id"),array("Coach_Email"=>$coach),1,"Plan_id",1)['Plan_id'];
}

}
?>