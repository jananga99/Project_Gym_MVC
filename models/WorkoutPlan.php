<?php

class WorkoutPlan extends Model{


function __construct($id){
    parent::__construct();
    $this->id = $id;
}   


//Returns all plans created by a coach
static function getAllPlansForACoach($coach_email){
    $plan_arr = array();
    foreach($this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan"),array("Coach_Email"=>$coach_email,"Delected"=>'0')) as $row)
       $plan_arr[] = array('Plan_Name'=>$row['Plan_Name'],'Plan_id'=>$row['Plan_id'],
       'Plan'=>unserialize( $row['Plan'] ));
    return $plan_arr;
}


//Returns all plans for a customer
static function getAllPlansForACustomer($customer_email){
    $plan_reg_arr = $this->db->select("Plan_Registration",array("Plan_id"),array("Customer"=>$customer_email));
    $plan_arr = array();
    foreach($plan_reg_arr as $p)
        $plan_arr[] = self::getPlan($p['Plan_id']);
    return $plan_arr;
}


//Returns data of given plan
static function getPlan($plan_id){
    $row = $this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan","Coach_Email"),array("Plan_id"=>$plan_id),1);
    return array('Plan_Name'=>$row['Plan_Name'],'Plan_id'=>$row['Plan_id'],'Plan'=>unserialize( $row['Plan'] ));
}


//Returns data of this plan
function getData(){
    return self::getPlan($this->id);
}


//Returns created coach for the plan
function getCreatedCoach(){
    return $this->db->select("Plan_details",array("Coach_Email"),
    array("Plan_id"=>$this->id),1)['Coach_Email'];
}


//Returns registered customers for this plan
function getCustomersForPlan(){
    $customer_arr = array();
    foreach($this->db->select("Plan_Registration",array("Customer"),array("Plan_id"=>$this->id)) as $row)
        $customer_arr[] = $row['Customer'];
    return $customer_arr;
}


//Creates a workout plan
static function create($coach_email,$data){
    $this->db->insert("Plan_details",array("Plan"=>serialize($data['plan']),"Plan_Name"=>$data['plan_name'],
    "Coach_email"=>$coach_email),"sss");
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


//Get the latest created session by givem coach
static function getLatestCreatedPlan($coach){
    return $this->db->select("Plan_details",array("Plan_id"),array("Coach_Email"=>$coach),1,"Plan_id",1)['Plan_id'];
}

}
?>