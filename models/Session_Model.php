<?php

class Session_Model extends Model{

function __construct(){
    parent::__construct();
}




function update($id,$data){
    $this->db->update("Session",
    array("Coach_Email"=>$data['coach'],"Session_Name"=>$data['name'],"Date_and_Time"=>$data['dt'],
    "Duration"=>$data['duration'],"Num_Participants"=>$data['num_participants']),array("Session_id"=>$id),'sssss');
}

function search($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Session_id","Coach_Email","Session_Name","Date_and_Time","Duration","Num_Participants");
    return $this->db->select("Session",$fields,$sort_arr,0,$orderField,$reverse);
}

function view($id){
    return $this->db->select("Session",0,array("Session_id"=>$id),1);
}

function register($customer,$session_id){
    $this->db->insert("Session_registration",array("Session_id"=>$session_id,"Customer"=>$customer),"ss");

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
        $coach_arr[] = $this->view($row['Session_id']);
    }
    return $coach_arr;
}


function add($coach,$data){
    $this->db->insert("Session",
    array("Coach_Email"=>$coach,"Session_Name"=>$data['sessionName'],"Date_and_Time"=>$data["dateTime"],"Duration"=>$data["duration"],"Num_Participants"=>$data["maxParticipants"]),"sssss");
}






}
?>