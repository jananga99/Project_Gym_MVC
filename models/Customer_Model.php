<?php

class Customer_Model extends Model{

function __construct(){
    parent::__construct();
}


function getData($email){
    return $this->db->select("Customer",0,array("Email"=>$email),1);
}

function updateDetails($email,$data){
    $this->db->update("Customer",
    array("LastName"=>$data['lname'],"FirstName"=>$data['fname'],"Age"=>$data['age'],
    "Gender"=>$data['gender'],"Telephone"=>$data['tel']),array("Email"=>$data['email']),'ssdss');
}

function searchCoach($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    return $this->db->select("Coach",$fields,$sort_arr,0,$orderField,$reverse);
}

function viewCoach($email){
    return $this->db->select("Coach",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", "City"),array("Email"=>$email),1);
}

function addCoach($customer,$coach){
    $this->db->insert("Registration",array("Customer"=>$customer, "Coach"=>$coach),"ss");
}

function isCoachRegistered($customer,$coach){
    if($this->db->select("Registration",array("Customer","Coach"),array("Customer"=>$customer,
    "Coach"=>$coach),1))
        return True;
    else
        return False;    
}

function registeredCoaches($email){
    $coach_arr = array();
    foreach( $this->db->select("Registration",array("Coach"),array("Customer"=>$email)) as $row ) {
        $coach_arr[] = $this->viewCoach($row['Coach']);
    }
    return $coach_arr;
}

//Observer
public function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}




}
?>