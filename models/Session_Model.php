<?php

class Session_Model extends Model{

function __construct(){
    parent::__construct();
}


//TODO : CHANGE THIS
function getRegisterCustomersForCoach($coach){
    return $this->db->select("Registration",array("Customer"),array("Coach"=>$coach));
}

//TODO : CHANGE THIS
function getRegisterCustomersForSession($session_id){
    return $this->db->select("session_registration",array("Customer"),array("Session_id"=>$session_id));
}

//Get the latest created session by logged in coach
//TODO
function getLatestCreatedSession($coach){
    return $this->db->select("Session_details",array("Session_id"),array("Coach_Email"=>$coach),1,"Session_id",1)['Session_id'];
}


//Notifies $rec_type $email user about $type notification.
function notify($rec_email,$rec_type,$type,$details){   
    $this->db->insert("notifications",array("Receiver_Email"=>$rec_email,"Receiver_Type"=>$rec_type,"Notification_Type"=>$type,"Details"=>$details),'ssss');
}

//Returns the coach who created the session for given session  id
function getCreatedCoach($id){
    return $this->db->select("session_details",array("Coach_Email"),array("Session_id"=>$id),1)['Coach_Email'];    
}

function update($id,$data){
    //TODO notify all customers
    $this->db->update("Session_details",
    array("Session_Name"=>$data['session_name'],"Date"=>$data['date'],"Start_Time"=>$data['startTime'],"End_Time"=>$data['endTime'],
    "Num_Participants"=>$data['num_participants'],"Price"=>$data['price']),array("Session_id"=>$id),'sssssd');
}

function search($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time","Num_Participants","Price","Details");
    return $this->db->select("session_details",$fields,$sort_arr,0,$orderField,$reverse);
}

function view($id){
    return $this->db->select("session_details",0,array("Session_id"=>$id),1);
}

function register($customer,$session_id){
    $this->db->insert("Session_registration",array("Session_id"=>$session_id,"Customer"=>$customer),"ss");
}

function unregister($customer,$session_id){
    $this->db->delete("Session_registration",array("Session_id"=>$session_id,"Customer"=>$customer),"ss");
}

function remove($session_id){
    //TODO notify all customers and delete theirs too
    $this->db->delete("Session_details",array("Session_id"=>$session_id),'s');
}


function isSessionRegistered($customer,$session_id){
    if($this->db->select("Session_registration",array("Session_id"),array("Customer"=>$customer,
    "Session_id"=>$session_id),1))
        return True;
    else
        return False;    
}


function registeredSessions($email){
    $session_arr = array();
    foreach( $this->db->select("Session_Registration",array("Session_id"),array("Customer"=>$email)) as $row ) {
        $session_arr[] = $this->view($row['Session_id']);
    }
    return $session_arr;
}

function createdSessions($email){
    return $this->search(array("Coach_Email"=>$email));
}

function add($coach,$data){
    //TODO check whether date is in future
    //TODO check start Time < End Time
    //TODO any other sessions in same time span as this coach
    $this->db->insert("session_details",
    array("Coach_Email"=>$coach,"Session_Name"=>$data['sessionName'],"Date"=>$data["date"],"Start_Time"=>$data["startTime"],"End_Time"=>$data["endTime"],"Num_Participants"=>$data["maxParticipants"],"Price"=>$data["price"],"Details"=>$data["details"]),"ssssssds");
}






}
?>