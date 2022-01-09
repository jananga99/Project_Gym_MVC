<?php

class WorkoutPlan_Helper extends Helper{

function __construct(){
    parent::__construct();
}


//Get the latest sent message
function getLatestPlanId($coach_email){
    return $this->db->select("plan_details",array("Plan_id"),array("Coach_Email"=>$coach_email),1,"Plan_id",1)['Plan_id'];
}


//Returns all plans created by a coach
function getAllPlansForACoach($coach_email){
    $plan_arr = array();
    foreach($this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan"),array("Coach_Email"=>$coach_email,"Delected"=>'0')) as $row)
       $plan_arr[] = array('Plan_Name'=>$row['Plan_Name'],'Plan_id'=>$row['Plan_id'],
       'Plan'=>unserialize( $row['Plan'] ));
    return $plan_arr;
}


//Returns all plans for a customer
function getAllPlansForACustomer($customer_email){
    $plan_reg_arr = $this->db->select("Plan_Registration",array("Plan_id"),array("Customer"=>$customer_email));
    $plan_arr = array();
    foreach($plan_reg_arr as $p)
        $plan_arr[] = self::getPlan($p['Plan_id']);
    return $plan_arr;
}


//Returns data of given plan
function getPlan($plan_id){
    $row = $this->db->select("Plan_details",array("Plan_id","Plan_Name","Plan","Coach_Email"),array("Plan_id"=>$plan_id),1);
    return array('Plan_Name'=>$row['Plan_Name'],'Plan_id'=>$row['Plan_id'],'Plan'=>unserialize( $row['Plan'] ));
}


//Get the latest created session by givem coach
function getLatestCreatedPlan($coach){
    return $this->db->select("Plan_details",array("Plan_id"),array("Coach_Email"=>$coach),1,"Plan_id",1)['Plan_id'];
}



}
?>