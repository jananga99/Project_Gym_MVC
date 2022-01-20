<?php


class Session_Helper extends Helper{

function __construct(){
    parent::__construct();
}
    

//Get the latest created session by logged in coach
function getLatestCreatedSession($coach){
    return $this->db->select("Session_details",array("Session_id"),array("Coach_Email"=>$coach),1,"Session_id",1)['Session_id'];
}


//Returns Sessions id if given customer registered for session
function isCustomerRegistered($customer,$session_id){
    return $this->db->select("Session_registration",array("Session_id"),array("Customer"=>$customer,
    "Session_id"=>$session_id,"Delected"=>'0'),1)['Session_id'] ;  
}


//Returns al registered sessions by given customer email
function registeredSessions($email){
    $session_arr = array();
    foreach( $this->db->select("Session_Registration",array("Session_id"),
    array("Customer"=>$email,"Delected"=>'0')) as $row ) 
        $session_arr[] = $this->getSessionData($row['Session_id']);
    return $session_arr;
}


//Returns all unregistered sessions by given customer email
function unregisteredSessions($email){
    $session_arr = array();
    foreach( $this->getAllSessions() as $row ){
        if(!$this->isCustomerRegistered($email,$row['Session_id'])){
            $session_arr[] = $this->getSessionData($row['Session_id']);
        }
    }  
    return $session_arr;   
}


//Get the Session data for given session_id
function getSessionData($session_id){
    return $this->db->select("session_details",0,array("Session_id"=>$session_id,"Delected"=>'0'),1);
}


//Returns created sessions for given coach_email
function createdSessions($email){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    return $this->db->select("session_details",$fields,array("Coach_Email"=>$email,"Delected"=>'0'));
}


//Returns all the sessions
function getAllSessions(){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    $sort_arr=array();
    $sort_arr['Delected'] = '0';
    return $this->db->select("session_details",$fields,$sort_arr,0,"Date");    
}


//Returns all customers registered for the sesssion
function registeredCustomers($id){
    $customer_arr = array();
    foreach( $this->db->select("Session_Registration",array("Customer"),
    array("Session_id"=>$id,"Delected"=>'0')) as $row ) 
        $customer_arr[] = $row['Customer'];
    return $customer_arr;
}


//Returns the coach who created the session 
function getCreatedCoach($id){
    return $this->db->select("session_details",array("Coach_Email"),
    array("Session_id"=>$id),1)['Coach_Email'];    
}


//Get the Session data
function getData($id){
    return $this->db->select("session_details",0,array("Session_id"=>$id,"Delected"=>'0'),1);
}



}




?>