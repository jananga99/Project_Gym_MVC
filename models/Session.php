<?php


class Session extends Model implements Observable{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Returns created sessions for given coach_email
static function createdSessions($email){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    return self::$dbStatic->select("session_details",$fields,array("Coach_Email"=>$email,"Delected"=>'0'));
}


//Returns the coach who created the session 
function getCreatedCoach(){
    return $this->db->select("session_details",array("Coach_Email"),
    array("Session_id"=>$this->id),1)['Coach_Email'];    
}


//Get the Session data
function getData(){
    return $this->db->select("session_details",0,array("Session_id"=>$this->id,"Delected"=>'0'),1);
}


//Get the Session data for given session_id
static function getSessionData($session_id){
    return self::$dbStatic->select("session_details",0,array("Session_id"=>$session_id,"Delected"=>'0'),1);
}


//Deletes the session
function delete(){
    //delete session registrations
    $this->db->update("Session_details",array("Delected"=>'1'),array("Session_id"=>$this->id,"Delected"=>'0'),'d');
}


//Edits the sessin details
function edit($data,$dataTypes){
    $this->db->update("Session_details",$data,array("Session_id"=>$this->id,"Delected"=>'0'),$dataTypes);
}


//Returns all the sessions
function getAllSessions($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    if($sort_arr==0)    $sort_arr=array();
    $sort_arr['Delected'] = '0';
    return self::$dbStatic->select("session_details",$fields,$sort_arr,0,$orderField,$reverse);
}


//Registers given customer for the session
function register($customer){
    $this->db->insert("Session_registration",array("Session_id"=>$this->id,"Customer"=>$customer),"ds");

}


//Unregisters current customer from session
function unregister($customer){
    $this->db->update("Session_registration",array("Delected"=>'1'),array("Session_id"=>$this->id,
    "Customer"=>$customer,"Delected"=>'0'),"d");
}


//Returns Sessions id if given customer registered for session
function isCustomerRegistered($customer){
    return $this->db->select("Session_registration",array("Session_id"),array("Customer"=>$customer,
    "Session_id"=>$this->id,"Delected"=>'0'),1)['Session_id'] ;  
}


//Returns al registered sessions by given customer email
static function registeredSessions($email){
    $session_arr = array();
    foreach( self::$dbStatic->select("Session_Registration",array("Session_id"),
    array("Customer"=>$email,"Delected"=>'0')) as $row ) 
        $session_arr[] = self::getSessionData($row['Session_id']);
    return $session_arr;
}


/////////////////////////////////////////////////////////////////////////////////////////////////

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