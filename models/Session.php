<?php

require "models/Coach.php";
require "models/Customer.php";
require "models/Admin.php";

class Session extends Model implements Observable{

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

//Returns the coach who created the session for given session  id
function getCreatedCoach($id){
    return $this->db->select("session_details",array("Coach_Email"),array("Session_id"=>$id),1)['Coach_Email'];    
}

function updateDetails($id,$data){
    //TODO notify all customers
    $this->db->update("Session_details",
    array("Session_Name"=>$data['session_name'],"Date"=>$data['date'],"Start_Time"=>$data['startTime'],"End_Time"=>$data['endTime'],
    "Num_Participants"=>$data['num_participants'],"Price"=>$data['price'],"Details"=>$data['details']),array("Session_id"=>$id),'sssssds');
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



//Observable
function notifyObservers($data){
    $type = $data['notification_type'];  
    if($type===NOTIFICATION_SESSION_REGISTER || $type===NOTIFICATION_SESSION_UNREGISTER){
        $coach = $this->getCreatedCoach($data['session_id']);
        $details = $data['customer_email']." Customer ";
        if($type===NOTIFICATION_SESSION_UNREGISTER)   $details.= "unregistered from";
        else   $details.= "registered for";
        $details.=" the Session (Session id = ".$data['session_id']." )";
        $data = array();
        $data['rec_email'] = $coach;
        $data['details'] = $details;
        $data['type'] = $type;
        $observer = new Coach();
        $observer->update($data);    
    }elseif($type===NOTIFICATION_SESSION_CREATE){
        $registered_customers =  $this->getRegisterCustomersForCoach($data['coach_email']);
        $session_id = $this->getLatestCreatedSession($data['coach_email']);
        foreach($registered_customers as $reg_customer){
            $details = $data['coach_email']." Coach created a Session (id = ".$session_id." )";  
            $data = array();
            $data['rec_email'] = $reg_customer['Customer'];
            $data['details'] = $details;
            $data['type'] = $type;
            $observer = new Customer();
            $observer->update($data);                      
        }
    }elseif($type===NOTIFICATION_SESSION_DELETE){
        
        $registered_customers =  $this->getRegisterCustomersForSession($data['session_id']);
        //TODO
        foreach($registered_customers as $reg_customer){
            $details = $data['coach_email']." Coach delected the Session (id = ".$data['session_id']." ). You will be refunded.";  
            $data1 = array();
            $data1['rec_email'] = $reg_customer['Customer'];
            $data1['details'] = $details;
            $data1['type'] = $type;
            $observer = new Customer();
            $observer->update($data1);
        }      
    }elseif($type===NOTIFICATION_SESSION_EDIT){
        
        $registered_customers =  $this->getRegisterCustomersForSession($data['session_id']);
        //TODO
        foreach($registered_customers as $reg_customer){
            $details = $data['coach_email']." Coach edited the Session (id = ".$data['session_id']." )";  
            $data1 = array();
            $data1['rec_email'] = $reg_customer['Customer'];
            $data1['details'] = $details;
            $data1['type'] = $type;
            $observer = new Customer();
            $observer->update($data1);
        }      
    }

}



}
?>